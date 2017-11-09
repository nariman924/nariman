<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "xml_file_tags".
 *
 * @property integer $id
 * @property integer $file_id
 * @property string $tag_name
 * @property string $entries
 *
 * @property XmlFile $file
 */
class XmlFileTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xml_file_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id'], 'integer'],
            [['entries'], 'safe'],
            [['tag_name'], 'string', 'max' => 200],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => XmlFile::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'tag_name' => Yii::t('app', 'Tag Name'),
            'entries' => Yii::t('app', 'Entries'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(XmlFile::className(), ['id' => 'file_id']);
    }

    public static function fileCountOver20Tags()
    {
        return (new Query())
            ->select(['c' => 'COUNT(id)'])
            ->from(self::tableName())
            ->groupBy('file_id')
            ->having(['>', 'c', 20])
            ->count('c');
    }

    public static function fileCountOver20AllTags()
    {
        return (new Query())
            ->select(['s' => 'SUM(entries)'])
            ->from(self::tableName())
            ->groupBy('file_id')
            ->having(['>', 's', 20])
            ->count('s');
    }
}
