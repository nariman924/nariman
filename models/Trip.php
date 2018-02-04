<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip".
 *
 * @property integer $id
 * @property integer $corporate_id
 * @property integer $number
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $coordination_at
 * @property integer $saved_at
 * @property integer $tag_le_id
 * @property integer $trip_purpose_id
 * @property integer $trip_purpose_parent_id
 * @property string $trip_purpose_desc
 * @property integer $status
 *
 * @property TripService[] $tripServices
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corporate_id', 'number', 'user_id', 'created_at', 'updated_at', 'coordination_at', 'saved_at', 'tag_le_id', 'trip_purpose_id', 'trip_purpose_parent_id', 'trip_purpose_desc', 'status'], 'required'],
            [['corporate_id', 'number', 'user_id', 'created_at', 'updated_at', 'coordination_at', 'saved_at', 'tag_le_id', 'trip_purpose_id', 'trip_purpose_parent_id', 'status'], 'integer'],
            [['trip_purpose_desc'], 'string'],
            [['corporate_id', 'number'], 'unique', 'targetAttribute' => ['corporate_id', 'number'], 'message' => 'The combination of Corporate ID and Number has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'corporate_id' => Yii::t('app', 'Corporate ID'),
            'number' => Yii::t('app', 'Number'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Дата и время создания'),
            'updated_at' => Yii::t('app', 'Дата и время последнего обновления'),
            'coordination_at' => Yii::t('app', 'Дата и время согласования'),
            'saved_at' => Yii::t('app', 'Дата и время сохранения'),
            'tag_le_id' => Yii::t('app', 'Tag Le ID'),
            'trip_purpose_id' => Yii::t('app', 'Trip Purpose ID'),
            'trip_purpose_parent_id' => Yii::t('app', 'Trip Purpose Parent ID'),
            'trip_purpose_desc' => Yii::t('app', 'Цель командировки'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTripServices()
    {
        return $this->hasMany(TripService::className(), ['trip_id' => 'id']);
    }
}
