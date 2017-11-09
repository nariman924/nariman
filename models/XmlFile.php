<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\components\XmlFileTagFactory;

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
            $this->name = $this->uploadedFile->baseName . '.' . $this->uploadedFile->extension;
            $this->upload_at = date('Y-m-d H:i:s');

            try {
                $tagsFactory = new XmlFileTagFactory($this->uploadedFile->tempName);
                $xmlFileTags = $tagsFactory->getModels();
            } catch (\Exception $e) {
                $this->addError('uploadedFile', Yii::t('app', 'An error occurred while parse the file'));

                return false;
            }

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $this->save();

                foreach ($xmlFileTags as $xmlFileTag) {
                    $this->link('xmlFileTags', $xmlFileTag);
                }

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                $this->addError('uploadedFile', Yii::t('app', 'An error occurred while saving the file'));

                return false;
            }

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

    /**
     * @return array
     */
    public function getTagsForView()
    {
        return $this->getXmlFileTags()
            ->select(['tag_name', 'entries'])
            ->orderBy(['tag_name' => SORT_ASC])
            ->all();
    }

    public static function getDataProvider()
    {
        $query = XmlFile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
