<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "xml_file".
 *
 * @property integer $id
 * @property string $name
 * @property string $upload_at
 *
 * @property XmlFileTag[] $xmlFileTags
 */
class XmlFile extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $uploadedFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xml_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['uploadedFile'], 'required'],
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xml'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->uploadedFile->saveAs(Yii::getAlias('@uploads/') . $this->uploadedFile->baseName . '.' . $this->uploadedFile->extension);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'upload_at' => Yii::t('app', 'Upload At'),
            'uploadedFile' => Yii::t('app', 'XML File'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXmlFileTags()
    {
        return $this->hasMany(XmlFileTag::className(), ['file_id' => 'id']);
    }
}
