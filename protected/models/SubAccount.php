<?php

/**
 * This is the model class for table "tbl_sub_account".
 *
 * The followings are the available columns in table 'tbl_sub_account':
 * @property integer $id
 * @property integer $main_account
 * @property string $username
 * @property string $password
 * @property string $status
 *
 * The followings are the available model relations:
 * @property MainAccount $mainAccount
 */
class SubAccount extends CActiveRecord
{
	const SUB_ACCOUNT_STATUS_ACTIVE = "active";
	const SUB_ACCOUNT_STATUS_INACTIVE = "inactive";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_sub_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main_account', 'numerical', 'integerOnly'=>true),
			array('username,status, password', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, main_account, username, password', 'safe', 'on'=>'search'),
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
			'mainAccount' => array(self::BELONGS_TO, 'MainAccount', 'main_account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'main_account' => 'Main Account',
			'username' => 'Username',
			'password' => 'Password',
			'status' => 'Status',
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
		$criteria->compare('main_account',$this->main_account);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SubAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function remoteDelete()
	{
		$curlURL = "https://www.voipinfocenter.com/API/Request.ashx?";
		$httpParams = array(
			"command"=>"changeuserinfo",
			"username"=>$this->mainAccount->username,
			"password"=>$this->mainAccount->retype_password,
			"customer"=>$this->username,
			"customerblocked"=>'true',
		);
		$curlURL .= http_build_query($httpParams);
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
		$curlResRaw = curl_exec($curlres);
		return $curlResRaw;
	}
	public function registerRemote()
	{
		$curlURL = "https://www.voipinfocenter.com/API/Request.ashx?";
		$httpParams = array(
			"command"=>"createcustomer",
			"username"=>$this->mainAccount->username,
			"password"=>$this->mainAccount->retype_password,
			"customer"=>$this->username,
			"customerpassword"=>$this->password,
		);
		$curlURL .= http_build_query($httpParams);
		$curlres = curl_init($curlURL);
		curl_setopt($curlres, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlres, CURLOPT_SSL_VERIFYHOST, false);
		$curlResRaw = curl_exec($curlres);
		return $curlResRaw;
	}
}
