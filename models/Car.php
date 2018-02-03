<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%car}}".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $categoryId
 * @property string $title
 * @property string $image
 * @property integer $price
 * @property string $url
 * @property integer $year
 * @property integer $created_at
 * @property integer $updated_at
 */
class Car extends \yii\db\ActiveRecord
{
    const UPLOAD_PATH = '@webroot/uploads/car/img/';
    const UPLOAD_BASE_URL = '@web/uploads/car/img/';

    const CAT_NISSAN = 1;
    const CAT_VOLVO = 2;
    const CAT_FORD = 3;

    const STATUS_AV = 1;
    const STATUS_UN_AV = 2;

    private static $category;
    private static $status;
    private static $years;

    /**
     * @var UploadedFile
     */
    public $uploadedFile;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'url',
            ],
        ];
    }

    public static function getYears()
    {
        if (!isset(self::$years)) {
            $range = range(date('Y') - 30 , date('Y') + 3, 1);
            self::$years = array_combine($range, $range);
        }
        return self::$years;
    }

    public static function getCategories()
    {
        if (!isset(self::$category)) {
            self::$category = [
                self::CAT_NISSAN => Yii::t('app', 'Nissan'),
                self::CAT_VOLVO => Yii::t('app', 'Volvo'),
                self::CAT_FORD => Yii::t('app', 'Ford'),
            ];
        }

        return self::$category;
    }

    public static function getStatuses()
    {
        if (!isset(self::$status)) {
            self::$status = [
                self::STATUS_AV => Yii::t('app', 'Available'),
                self::STATUS_UN_AV => Yii::t('app', 'Unavailable'),
            ];
        }

        return self::$status;
    }

    public function getCategory()
    {
        $list = self::getCategories();

        return $list[$this->categoryId] ?? null;
    }

    public function getStatus()
    {
        $list = self::getStatuses();

        return $list[$this->status] ?? null;
    }

    public function getLink()
    {
        return Url::to(['car/view', 'slug' => Html::encode($this->url)], true);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%car}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'categoryId', 'price', 'year', 'created_at', 'updated_at'], 'integer'],
            [
                ['title', 'url', 'status', 'categoryId', 'price', 'year'],
                'required'
            ],
            [['title', 'image', 'url'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['uploadedFile'], 'required'],
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'status' => Yii::t('app', 'Status'),
            'categoryId' => Yii::t('app', 'Models'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'uploadedFile' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'url' => Yii::t('app', 'Url to car'),
            'year' => Yii::t('app', 'Year'),
            'created_at' => Yii::t('app', 'Create date'),
            'updated_at' => Yii::t('app', 'Update date'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $newName = Yii::$app->security->generateRandomString() . '.' . $this->uploadedFile->extension;
            $this->image = $newName;
            $this->uploadedFile->saveAs(Yii::getAlias(self::UPLOAD_PATH) . $newName);

            return true;
        } else {
            return false;
        }
    }
}
