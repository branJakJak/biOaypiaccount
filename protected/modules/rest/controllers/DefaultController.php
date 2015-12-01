<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		throw new CHttpException(404,"Page doesnt exists");
	}
}