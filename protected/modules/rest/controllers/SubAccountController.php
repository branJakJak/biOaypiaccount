<?php 

/**
* SubAccountController
*/
class SubAccountController extends Controller
{
	private $json_message;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('index','delete','register','generateRandomData'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		// header("Content-Type: application/json");
		if (Yii::app()->request->isPostRequest) {
			/*capture query object */
			$queryObject = file_get_contents("php://input");
			$queryObject = json_decode($queryObject);
			/*search sub accounts using main account*/
			$resultsArr= $this->searchSubAccount($queryObject);
			echo CJSON::encode($resultsArr);
		}else{
			/*return all sub accounts*/
			$allModels = SubAccount::model()->findAll();
			echo CJSON::encode($allModels);
		}
	}
	public function actionDelete()
	{
		header("Content-Type: application/json");
		$postedData = json_decode(file_get_contents("php://input"));
		/*delete at the database */
		$model = SubAccount::model()->findByPk($postedData->id);
		if ($model) {
			/*if main account status is active  - delete at the api*/
			$result = $model->remoteDelete();
			$xmlObj = simplexml_load_string($result);
			if (isset($xmlObj->Result) && ( (string)$xmlObj->Result ) !== 'Failed') {
				$model->delete();
				$this->json_message = array(
						"status"=>"ok",
						"message"=>"Sub account deleted.",
				);				
			}else{
				$this->json_message = array(
					"status"=>"failed",
					"message"=>(string)$xmlObj->Reason,
				);			
			}
		}else{
			$this->json_message = array(
					"status"=>"failed",
					"message"=>"Deletion failed",
			);
		}
		echo json_encode($this->json_message);
	}
	public function actionGenerateRandomData()
	{
		header("Content-Type: application/json");
		$faker = \Faker\Factory::create();
		$result = array(
				"username"=>$faker->username,
				"password"=>$faker->password
			);
		echo json_encode($result);
	}
	public function actionRegister()
	{
		header("Content-Type: application/json");
		$postedData = json_decode(file_get_contents("php://input"));
		$newSubAcct = new SubAccount();
		$newSubAcct->main_account = $postedData->main->id;
		$newSubAcct->username = $postedData->sub->username;
		$newSubAcct->password = $postedData->sub->password;
		if ($newSubAcct->validate()) {
			$res = $newSubAcct->registerRemote();
			$xmlObj = simplexml_load_string($res);
			if (isset($xmlObj->Result) && strtolower((string)$xmlObj->Result) !== 'failed') {
				$newSubAcct->save();
				$this->json_message = array(
						'status'=>'ok',
						'message'=>'ok'
				);							
			}else{
				$this->json_message = array(
						'status'=>'failed',
						'message'=>(string)$xmlObj->Reason
				);							
			}
		}else{
			$this->json_message = array(
					'status'=>'failed',
					'message'=>CHtml::errorSummary($newSubAcct)
				);
		}
		echo json_encode($this->json_message);
	}
	private function searchSubAccount($queryObject)
	{
		$criteria = new CDbCriteria;
		$criteria->compare("main_account", $queryObject->main_account);
		$criteria->compare("username"  , $queryObject->username);
		$criteria->compare("password"  , $queryObject->password);
		return SubAccount::model()->findAll($criteria);
	}



}