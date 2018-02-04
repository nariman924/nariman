<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip_service".
 *
 * @property integer $id
 * @property integer $trip_id
 * @property integer $service_id
 * @property integer $status
 * @property integer $type_booking
 * @property integer $variants
 * @property string $price
 * @property string $currency
 * @property string $confirmation_number
 * @property integer $deadline
 * @property integer $date_start
 * @property integer $date_end
 * @property integer $start_city_id
 * @property integer $start_point_id
 * @property integer $end_point_id
 * @property integer $end_city_id
 * @property string $description
 *
 * @property Trip $trip
 */
class TripService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trip_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trip_id', 'service_id', 'type_booking', 'variants', 'description'], 'required'],
            [['trip_id', 'service_id', 'status', 'type_booking', 'variants', 'deadline', 'date_start', 'date_end', 'start_city_id', 'start_point_id', 'end_point_id', 'end_city_id'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['currency'], 'string', 'max' => 3],
            [['confirmation_number'], 'string', 'max' => 16],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['trip_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trip_id' => Yii::t('app', 'Trip ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'status' => Yii::t('app', 'Status'),
            'type_booking' => Yii::t('app', 'Тип заказа'),
            'variants' => Yii::t('app', 'Варианты'),
            'price' => Yii::t('app', 'Price'),
            'currency' => Yii::t('app', 'Currency'),
            'confirmation_number' => Yii::t('app', 'Confirmation Number'),
            'deadline' => Yii::t('app', 'Deadline'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'start_city_id' => Yii::t('app', 'Start City ID'),
            'start_point_id' => Yii::t('app', 'Start Point ID'),
            'end_point_id' => Yii::t('app', 'End Point ID'),
            'end_city_id' => Yii::t('app', 'End City ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'trip_id']);
    }
}
