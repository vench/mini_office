<?php

/**
 * This is the model class for table "Documents".
 *
 * The followings are the available columns in table 'Documents':
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property string $description
 * @property string $url
 * @property string $typedata
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Documents extends CActiveRecord
{
	const TYPE_TEMPL = 1;
	
	const TYPE_BLANKS = 2;

	/**
	* @return array
	*/
	public static function getTypes() {
		return array(
			self::TYPE_TEMPL=>'Шаблон',
			self::TYPE_BLANKS=>'Бланки',
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Documents';
	}
	
	/**
	* $return string
	*/
	public function getTypeStr() {
		$data = self::getTypes();
		return isset($data[$this->type]) ? $data[$this->type] : '';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, description', 'required'),
			array('type, user_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>128),
			array('typedata', 'boolean'),	
			array('url', 'safe',),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, user_id, description, url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	
	/**
	* @return string
	*/
	public function getAlias() {
		return "webroot.uploads.documents";//'application.uploads.documents';//
	}
	
	
	/**
	* @return string
	*/
	public function getUrlLink() {
		return Yii::app()->baseUrl.'/uploads/documents/'.$this->url;
	}
	
	/**
	* @return string
	*/
	public function getFullPathFile() {
		return Yii::getPathOfAlias($this->getAlias()).DIRECTORY_SEPARATOR.$this->url;
	}
	
	/**
	* @return boolean
	*/
	public function isFileExists() {
		return $this->isLink() || file_exists($this->getFullPathFile());
	}
	
	public function isLink() {
		return $this->typedata == 1;
	}
	
	/**
	* Закачка файла
	*/
	public function download() {
		$filePath = $this->getFullPathFile();
		$data = pathinfo($filePath);
		header("Content-disposition: attachment; filename=document.{$data['extension']}");
        header("Content-type: application/{$data['extension']}");
        readfile($filePath);
	}
	
	/**
	*
	*/
	public function getDownloadLink() {
		return $this->isLink() ? $this->url : array('/docs/download', 'id'=>$this->getPrimaryKey());
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Тип',
			'user_id' => 'Создатель',
			'description' => 'Описание',
			'url' => 'Ссылка на документ',
			'typedata'=>'Ссылка',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	*	@return boolean
	*/
	protected function beforeSave() {		
		if(!is_null($image = CUploadedFile::getInstance($this,'url'))) {
			$dir = Yii::getPathOfAlias($this->getAlias());
			if(!is_dir($dir)) {
				mkdir($dir, 0777);
			}		
			$image->saveAs($dir.DIRECTORY_SEPARATOR.$image->name);
			$this->url = $image->name; 
		} 
		return parent::beforeSave();
	}
		
	/**
	*	@return boolean
	*/
	protected function beforeDelete() {
		if($this->isFileExists()) {
			@unlink($this->getFullPathFile());
		}
		return parent::beforeDelete();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
