<?php

namespace frontend\modules\mart\controllers;

use yii\web\Controller;
use frontend\modules\mart\models\LoadFile;
use  Yii;

/**
 * Default controller for the `pricelistautoload` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUploadfile(){
        $model = new LoadFile();
        if($model->load(Yii::$app->request->post())){
            if($model->getFile()){
                return $this->render('index');
            }
        }
        return $this->render('upload-form', [
            'model' => $model,
        ]);
    }
}
