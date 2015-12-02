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
				'actions'=>array('index','delete','checkMainAccounts'),
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
		$updatedArr = array();
		foreach ($allMainAccts as $key => $value) {
			$cur = $value->attributes;
			$cur['time_ago'] = TimeAgoHelper::timeAgo(strtotime($value->date_created));
			$updatedArr[] = $cur;
		}
		echo CJSON::encode($updatedArr);
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
	public function actionCheckMainAccounts()
	{
		header("Content-Type: application/json");
		$criteria = new CDbCriteria;
		$criteria->compare("status",MainAccount::MAIN_ACCT_STATUS_INACTIVE);
		$allMainAccounts = MainAccount::model()->findAll($criteria);
		$checker = new MainAccountChecker();
		foreach ($allMainAccounts as $key => $currentMainAccount) {
			if ($checker->isActive($currentMainAccount)) {
				$currentMainAccount->status = MainAccount::MAIN_ACCT_STATUS_ACTIVE;
				$currentMainAccount->save();//update status
			}
		}
		echo json_encode(array("status"=>"ok","message"=>"ok"));
	}
}