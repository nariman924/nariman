<?php

namespace app\controllers;

use Yii;
use app\models\XmlFile;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\XmlFileTag;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $language = Yii::$app->request->cookies->getValue('language', 'ru');
        Yii::$app->language = $language;

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new XmlFile();

        if (Yii::$app->request->isPost) {
            $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');

            if ($model->upload()) {
                $model = new XmlFile();
            }
        }

        $dataProvider = XmlFile::getDataProvider();
        $filesCount = XmlFileTag::fileCountOver20Tags();
        $filesCountAll = XmlFileTag::fileCountOver20AllTags();

        return $this->render('index', compact('model', 'dataProvider', 'filesCount', 'filesCountAll'));
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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect('index');
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
