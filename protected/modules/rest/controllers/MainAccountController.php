<?php 

/**
* MainAccountController
*/
class MainAccountController extends Controller
{
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
				'actions'=>array('index','delete'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		header("Content-Type: application/json");
		$criteria = new CDbCriteria;
		$criteria->order = "id desc";
		$allMainAccts = MainAccount::model()->findAll($criteria);
		echo CJSON::encode($allMainAccts);
	}
	public function actionDelete()
	{
		header("Content-Type: application/json");
		$postedData  = file_get_contents("php://input");
		$postedData = json_decode($postedData);
		$model = MainAccount::model()->findByPk($postedData->id);
		$model->delete();
		echo json_encode(array("status"=>"ok","message"=>"Main account deleted"));
	}

}