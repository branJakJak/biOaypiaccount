<?php 

/**
* TemplateGenerator
*/
class TemplateGenerator
{
	public function generate()
	{
		$model = new MainAccountModel();
		$model->save();
		$ccc = new CController('context');
		$fileName = tempnam(sys_get_temp_dir(), "asd");
		$fileName .= ".html";
		$htmlOutput = $ccc->renderInternal(Yii::getPathOfAlias("application.views.templates").'/index.php',  $model->attributes, true);
		file_put_contents($fileName, $htmlOutput);
		return $fileName;
	}

}