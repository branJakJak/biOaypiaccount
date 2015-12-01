<?php

/**
 * This is the model class for table "tbl_main_account".
 *
 * The followings are the available columns in table 'tbl_main_account':
 * @property integer $id
 * @property string $status
 * @property string $company_name
 * @property string $company_website
 * @property string $contact_person
 * @property string $username
 * @property string $password
 * @property string $retype_password
 * @property string $street
 * @property string $house_number
 * @property string $post_code
 * @property string $city
 * @property string $country
 * @property string $fax
 * @property string $phone_number
 * @property string $email_address
 *
 * The followings are the available model relations:
 * @property SubAccount[] $subAccounts
 */
class MainAccount extends CActiveRecord
{
	const MAIN_ACCT_STATUS_ACTIVE = 'active';
	const MAIN_ACCT_STATUS_INACTIVE = 'unconfirmed';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_main_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name,status, company_website, contact_person, username, password, retype_password, street, house_number, post_code, city, country, fax, phone_number, email_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_name, company_website, contact_person, username, password, retype_password, street, house_number, post_code, city, country, fax, phone_number, email_address', 'safe', 'on'=>'search'),
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
			'subAccounts' => array(self::HAS_MANY, 'SubAccount', 'main_account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'company_name' => 'Company Name',
			'company_website' => 'Company Website',
			'contact_person' => 'Contact Person',
			'username' => 'Username',
			'password' => 'Password',
			'retype_password' => 'Retype Password',
			'street' => 'Street',
			'house_number' => 'House Number',
			'post_code' => 'Post Code',
			'city' => 'City',
			'country' => 'Country',
			'fax' => 'Fax',
			'phone_number' => 'Phone Number',
			'email_address' => 'Email Address',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_website',$this->company_website,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('retype_password',$this->retype_password,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('house_number',$this->house_number,true);
		$criteria->compare('post_code',$this->post_code,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email_address',$this->email_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MainAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
