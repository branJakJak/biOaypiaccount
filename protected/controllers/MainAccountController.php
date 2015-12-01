<?php


class MainAccountController extends Controller
{
    public $layout = "column2";

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
                'actions' => array('create','checkMainAccounts'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new MainAccountModel;

        if (isset($_POST['MainAccountModel'])) {
            $model->attributes = $_POST['MainAccountModel'];
            if ($model->validate()) {
                $model->save();
                $htmlOutput = $this->renderPartial('//templates/index', $model->attributes, true);
                $fileName = tempnam(sys_get_temp_dir(), "asd");
                $fileName .= ".html";
                file_put_contents($fileName, $htmlOutput);
                $publishedUrl = Yii::app()->assetManager->publish($fileName);
                Yii::app()->user->setFlash("success", CHtml::link('<span class="icon-download icon-white"></span> Download File', $publishedUrl, array('class' => 'btn btn-primary')));
                $this->redirect(array('/mainAccount/create'));
            }
        }
        $this->render('//main_account/form', array('model' => $model));
    }
    public function actionCheckMainAccounts()
    {
        header("Content-Type: application/json");
        /*get all unconfirmed main accounts*/
        $criteria = new CDbCriteria;
        $criteria->compare("status",MainAccount::MAIN_ACCT_STATUS_INACTIVE);
        $allModels = MainAccount::model()->findAll($criteria);
        $mainAccountChecker = new MainAccountChecker;
        foreach ($allModels as $key => $currentMainModel) {
            
        }
        echo json_encode(array("status"=>"ok","message"=>"All unconfirmed accounts checked"));
    }
}