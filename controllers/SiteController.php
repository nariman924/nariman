<?php

namespace app\controllers;

use app\models\XmlFile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new XmlFile();
        $dataProvider = XmlFile::search();

        if (Yii::$app->request->isPost) {
            $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');

            if ($model->upload()) {
                $model = new XmlFile();
            }
        }

        return $this->render('index', compact('model', 'dataProvider'));
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionInfo($id)
    {
        $model = $this->findModel($id);

        return $this->render('info', compact('model'));
    }

    protected function findModel($id)
    {
        if (($model = XmlFile::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}
