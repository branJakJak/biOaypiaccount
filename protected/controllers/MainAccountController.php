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
                'actions' => array('create','checkMainAccounts','bulk','exportAll','exportSubAccount','exportMain'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    public function actionBulk()
    {
        if (Yii::app()->request->isPostRequest) {
            $numOfItems = intval($_POST['numOfItems']);
            $archiveFileName = tempnam(sys_get_temp_dir(),uniqid()).'.zip';

            /*iterate n times*/
            $templateGenerator = new TemplateGenerator();
            $archiveFile = new ZipArchive();
            $archiveFile->open($archiveFileName , ZipArchive::CREATE);
            foreach (range(1, $numOfItems) as $key => $value) {
                /*generate template*/
                $template1 = $templateGenerator->generate();
                /*put to archive*/
                $archiveFile->addFromString(basename($template1) , file_get_contents($template1));
            }
            $archiveFile->close();
            /*publish archive file*/
            $publishedUrl = Yii::app()->assetManager->publish($archiveFileName);
            $messageoutput = CHtml::link('Download files', $publishedUrl);
            /*put link at flash*/
            Yii::app()->user->setFlash("success",$messageoutput);
            /*redirect */
            $this->redirect('/mainAccount/bulk');
            /*done*/
        }
        $this->render('//main_account/bulk');
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
    /**
     * @TODO - check if the main accounts exists the api
     * @return [type] [description]
     */
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
    public function actionExportMain()
    {
        $fileName = 'All Main Account credentias-'.date("Y-m-d");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");        

        $csvFile = sys_get_temp_dir().'/'.uniqid().'.csv';
        $csvFileObj = fopen($csvFile, "w+");
        $allMainAccounts = MainAccount::model()->findAll();
        foreach ($allMainAccounts as $key => $currentMainAccount) {
            /*write to csv*/ 
            fputcsv($csvFileObj, array($currentMainAccount->username,$currentMainAccount->password));
        }
        fclose($csvFileObj);
        echo file_get_contents($csvFile);
        /*download file*/                
    }
    public function actionIndex()
    {
        $this->redirect(array('create'));
    }
    public function actionExportSubAccount()
    {
        $fileName = 'All Sub Account credentias-'.date("Y-m-d");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");

        $csvFile = sys_get_temp_dir().'/'.uniqid().'.csv';
        $csvFileObj = fopen($csvFile, "w+");
        $allSubAccounts = SubAccount::model()->findAll();
        foreach ($allSubAccounts as $key => $currentSubAccount) {
            /*write to csv*/ 
            fputcsv($csvFileObj, array($currentSubAccount->username,$currentSubAccount->password));
        }
        fclose($csvFileObj);
        echo file_get_contents($csvFile);
        /*download file*/        
    }

    public function actionExportAll()
    {
        $fileName = 'All Account credentias-'.date("Y-m-d");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName.csv\";" );
        header("Content-Transfer-Encoding: binary");

        $csvFile = sys_get_temp_dir().'/'.uniqid().'.csv';
        $csvFileObj = fopen($csvFile, "w+");
        /*prepare CSV File*/
        /*find all main accounts*/
        $allMainAccount = MainAccount::model()->findAll();
        fputcsv($csvFileObj, array("Main Account","Sub Account","Password"));
        foreach ($allMainAccount as $key => $currentMainAccount) {
            /*find all sub accounts*/
            if (count($currentMainAccount->subAccounts) === 0) {
                fputcsv($csvFileObj, array($currentMainAccount->username,'',$currentMainAccount->password));
            }
            foreach ($currentMainAccount->subAccounts as $key => $currentSubAccountModel) {
                /*write to csv*/
                fputcsv($csvFileObj, array($currentMainAccount->username,$currentSubAccountModel->username,$currentSubAccountModel->password));
            }            
        }
        fclose($csvFileObj);
        echo file_get_contents($csvFile);
        /*download file*/
    }
}