<?php
/**
* Rights authorization manager class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @since 0.9.7
*/
class RDbAuthManager extends CDbAuthManager
{
	/**
	 * @var string the name of the rights table.
	 */

	private $_items = array();
	private $_itemChildren = array();

	/**
	 * Adds an item as a child of another item.
	 * Overloads the parent method to make sure that
	 * we do not add already existing children.
	 * @param string $itemName the item name.
	 * @param string $childName the child item name.
	 * @throws CException if either parent or child doesn't exist or if a loop has been detected.
	 */
	public function addItemChild($itemName, $childName)
	{
		// Make sure that the item doesn't already have this child.
		if( $this->hasItemChild($itemName, $childName)===false )
			return parent::addItemChild($itemName, $childName);
	}

	/**
	* Assigns an authorization item to a user making sure that
	* the user doesn't already have this assignment.
	* Overloads the parent method to make sure that
	* we do not assign already assigned items.
	* @param string $itemName the item name.
	* @param mixed $userId the user ID (see {@link IWebUser::getId})
	* @param string $bizRule the business rule to be executed when {@link checkAccess} is called
	* for this particular authorization item.
	* @param mixed $data additional data associated with this assignment.
	* @return CAuthAssignment the authorization assignment information.
	* @throws CException if the item does not exist or if the item has already been assigned to the user.
	*/
	public function assign($itemName, $userId, $bizRule=null, $data=null)
	{
		// Make sure that this user doesn't already have this assignment.
		if( $this->getAuthAssignment($itemName, $userId)===null )
			return parent::assign($itemName, $userId, $bizRule, $data);
	}

	/**
	* Returns the authorization item with the specified name.
	* Overloads the parent method to allow for runtime caching.
	* @param string $name the name of the item.
	* @param boolean $allowCaching whether to accept cached data.
	* @return CAuthItem the authorization item. Null if the item cannot be found.
	*/
	public function getAuthItem($name, $allowCaching=true)
	{
		// Get all items if necessary and cache them.
		if( $allowCaching && $this->_items===array() )
			$this->_items = $this->getAuthItems();

		// Get the items from cache if possible.
		if( $allowCaching && isset($this->_items[ $name ]) )
		{
			return $this->_items[ $name ];
		}
		// Attempt to get the item.
		else if( ($item = parent::getAuthItem($name))!==null )
		{
			return $item;
		}

		// Item does not exist.
		return null;
	}


	/**
	* Returns the specified authorization items.
	* @param array $names the names of the authorization items to get.
	* @param boolean $nested whether to nest the items by type.
	* @return array the authorization items.
	*/
	public function getAuthItemsByNames($names, $nested=false)
	{
		// Get all items if necessary and cache them.
		if( $this->_items===array() )
			$this->_items = $this->getAuthItems();

		// Collect the items we want.
		$items = array();
		foreach( $this->_items as $name=>$item )
		{
			if( in_array($name, $names) )
			{
				if( $nested===true )
					$items[ $item->getType() ][ $name ] = $item;
				else
					$items[ $name ] = $item;
			}
		}

		return $items;
	}

	/**
	* Returns the authorization items of the specific type and user.
	* Overloads the parent method to allow for sorting.
	* @param integer $type the item type (0: operation, 1: task, 2: role). Defaults to null,
	* meaning returning all items regardless of their type.
	* @param mixed $userId the user ID. Defaults to null, meaning returning all items even if
	* they are not assigned to a user.
	* @param boolean $sort whether to sort the items according to their weights.
	* @return array the authorization items of the specific type.
	*/
	public function getAuthItems($type=null, $userId=null)
	{

		$items = parent::getAuthItems($type, $userId);


		return $items;
	}

	/**
	 * Returns the children of the specified item.
	 * Overloads the parent method to allow for caching.
	 * @param mixed $names the parent item name. This can be either a string or an array.
	 * The latter represents a list of item names (available since version 1.0.5).
	 * @param boolean $allowCaching whether to accept cached data.
	 * @return array all child items of the parent
	 */
	public function getItemChildren($names, $allowCaching=true)
	{
		// Resolve the key for runtime caching.
		$key = $names===(array)$names ? implode('|', $names) : $names;

		// Get the children from cache if possible.
		if( $allowCaching && isset($this->_itemChildren[ $key ])===true )
		{
			return $this->_itemChildren[ $key ];
		}
		// Children not cached or cached data is not accepted.
		else
		{
			// We only have one name.
			if( is_string($names) )
			{
				$condition = 'parent='.$this->db->quoteValue($names);
			}
			// We have multiple names.
			else if( $names===(array)$names && $names!==array() )
			{
				foreach($names as &$name)
					$name=$this->db->quoteValue($name);

				$condition = 'parent IN ('.implode(', ', $names).')';
			}
			else
			{
				$condition = '1';
			}

			$sql = "SELECT name, type, description, bizrule, data
				FROM {$this->itemTable}, {$this->itemChildTable}
				WHERE {$condition} AND name=child";
			$children = array();
			foreach( $this->db->createCommand($sql)->queryAll() as $row )
			{
				if( ($data = @unserialize($row['data']))===false )
					$data = null;

				$children[ $row['name'] ] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], $data);
			}

			// Cache the result.
			return $this->_itemChildren[ $key ] = $children;
		}
	}

	public function getAssignmentsByItemName($name)
	{
		$sql = "SELECT * FROM {$this->assignmentTable} WHERE itemname=:itemname";
		$command = $this->db->createCommand($sql);
		$command->bindValue(':itemname', $name);

		$assignments=array();
		foreach($command->queryAll($sql) as $row)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;

			$assignments[ $row['userid'] ] = new CAuthAssignment($this, $row['itemname'], $row['userid'], $row['bizrule'], $data);
		}

		return $assignments;
	}

	public function getItemDirectParents($name)
	{
		$sql = "SELECT * FROM {$this->itemTable},{$this->itemChildTable} WHERE child=:itemname AND name=parent";
		$command = $this->db->createCommand($sql);
		$command->bindValue(':itemname', $name);

		$parents=array();
		foreach($command->queryAll($sql) as $row)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;

			$parents[] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], $data);
		}

		return $parents;
	}

	public function getItemDirectChildren($name)
	{
		$sql = "SELECT * FROM {$this->itemTable},{$this->itemChildTable} WHERE parent=:itemname AND name=child";
		$command = $this->db->createCommand($sql);
		$command->bindValue(':itemname', $name);

		$children=array();
		foreach($command->queryAll($sql) as $row)
		{
			if(($data=@unserialize($row['data']))===false)
				$data=null;

			$children[] = new CAuthItem($this, $row['name'], $row['type'], $row['description'], $row['bizrule'], $data);
		}

		return $children;
	}
	
	public function removeAuthItemFromChilds($itemName){
		
				$connection = Yii::app()->db;
				$command = $connection->createCommand("DELETE FROM {$this->itemChildTable} WHERE child = :itemname");
				$command->bindValue(':itemname', $itemName);
				
				return $command->execute();			
		
		}
	
	public function removeAuthItemFromParents($itemName){
		
				$connection = Yii::app()->db;
				$command = $connection->createCommand("DELETE FROM {$this->itemChildTable} WHERE parent = :itemname");
				$command->bindValue(':itemname', $itemName);
				return $command->execute();			
		
		}

	public function removeAuthItemFromAssignments($itemName){
		
				$connection = Yii::app()->db;
				$command = $connection->createCommand("DELETE FROM {$this->assignmentTable} WHERE itemname = :itemname");
				$command->bindValue(':itemname', $itemName);
				
				return $command->execute();			
		
		}
	
	public function getItemRelationsWithParents(){
			
			$sql = "SELECT * FROM {$this->itemTable} t1 Left outer JOIN {$this->itemChildTable} t2 ON t1.name = t2.parent";
			$command  =	$this->db->createCommand($sql);

			$items = $command->queryAll();		

			$data = array();
			if(is_array($items) && sizeof($items)>0)
				foreach( $items as $item )
					$data[] = $item;

			return $data;
		
		}

	public function getItemRelationsWithChildren(){
			
			$sql = "SELECT * FROM {$this->itemTable} t1 Left outer JOIN {$this->itemChildTable} t2 ON t1.name = t2.child";
			$command  =	$this->db->createCommand($sql);

			$items = $command->queryAll();		

			$data = array();
			if(is_array($items) && sizeof($items)>0)
				foreach( $items as $item )
					$data[] = $item;

			return $data;
		
		} 

}
