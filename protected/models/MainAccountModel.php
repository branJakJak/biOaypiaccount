<?php
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;


class MainAccountModel extends CFormModel{
    public $company_name;
    public $company_website;
    public $contact_person;
    public $username;
    public $password;
    public $retype_password;
    public $street;
    public $house_number;
    public $post_code;
    public $city;
    public $country;
    public $fax;
    public $phone_number;
    public $email_address;
    
    function __construct() {
        $generator = new ComputerPasswordGenerator();
        $generator
          ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, true)
          ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
          ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
        ;
        $password = $generator->generatePassword();
        $faker = \Faker\Factory::create();
        $this->company_name = $faker->company;
        $this->company_website = $faker->url;
        $this->contact_person = $faker->name;
        $this->username = $faker->userName;
        $this->password = $password;
        $this->retype_password = $password;
        $this->street = $faker->streetName;
        $this->house_number = $faker->randomDigit;
        $this->post_code = $faker->postcode;
        $this->city = $faker->city;
        $this->country = "United States";
        $this->email_address = $faker->email;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('company_name, company_website, contact_person, username, password, retype_password, street, house_number, post_code, city, country, fax, phone_number, email_address', 'length', 'max'=>255),
            array('id, company_name, company_website, contact_person, username, password, retype_password, street, house_number, post_code, city, country, fax, phone_number, email_address', 'safe', 'on'=>'search'),
        );
    }


    public function save()
    {
        /*saves the data in the db*/
        $newMainAccount = new MainAccount();
        $newMainAccount->attributes = $this->attributes;
        if (!$newMainAccount->save()) {
            throw new Exception("Sorry cant save new Main account . Reason : " . CHtml::errorSummary($newMainAccount));
        }
        return $newMainAccount;
    }

}