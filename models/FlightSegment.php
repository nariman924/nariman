<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flight_segment".
 *
 * @property integer $id
 * @property integer $flight_id
 * @property integer $num
 * @property integer $group
 * @property string $departureTerminal
 * @property string $arrivalTerminal
 * @property string $flightNumber
 * @property string $departureDate
 * @property string $arrivalDate
 * @property integer $stopNumber
 * @property integer $flightTime
 * @property integer $eTicket
 * @property string $bookingClass
 * @property string $bookingCode
 * @property integer $baggageValue
 * @property string $baggageUnit
 * @property integer $depAirportId
 * @property integer $arrAirportId
 * @property integer $opCompanyId
 * @property integer $markCompanyId
 * @property integer $aircraftId
 * @property integer $depCityId
 * @property integer $arrCityId
 * @property string $supplierRef
 * @property integer $depTimestamp
 * @property integer $arrTimestamp
 */
class FlightSegment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flight_segment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flight_id', 'num', 'group'], 'required'],
            [['flight_id', 'num', 'group', 'stopNumber', 'flightTime', 'eTicket', 'baggageValue', 'depAirportId', 'arrAirportId', 'opCompanyId', 'markCompanyId', 'aircraftId', 'depCityId', 'arrCityId', 'depTimestamp', 'arrTimestamp'], 'integer'],
            [['departureTerminal', 'arrivalTerminal', 'bookingCode'], 'string', 'max' => 1],
            [['flightNumber'], 'string', 'max' => 6],
            [['departureDate', 'arrivalDate'], 'string', 'max' => 20],
            [['bookingClass', 'baggageUnit'], 'string', 'max' => 16],
            [['supplierRef'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'flight_id' => Yii::t('app', 'Flight ID'),
            'num' => Yii::t('app', 'Num'),
            'group' => Yii::t('app', 'Group'),
            'departureTerminal' => Yii::t('app', 'Departure Terminal'),
            'arrivalTerminal' => Yii::t('app', 'Arrival Terminal'),
            'flightNumber' => Yii::t('app', 'Flight Number'),
            'departureDate' => Yii::t('app', 'Departure Date'),
            'arrivalDate' => Yii::t('app', 'Arrival Date'),
            'stopNumber' => Yii::t('app', 'Stop Number'),
            'flightTime' => Yii::t('app', 'Flight Time'),
            'eTicket' => Yii::t('app', 'E Ticket'),
            'bookingClass' => Yii::t('app', 'Booking Class'),
            'bookingCode' => Yii::t('app', 'Booking Code'),
            'baggageValue' => Yii::t('app', 'Baggage Value'),
            'baggageUnit' => Yii::t('app', 'Baggage Unit'),
            'depAirportId' => Yii::t('app', 'Dep Airport ID'),
            'arrAirportId' => Yii::t('app', 'Arr Airport ID'),
            'opCompanyId' => Yii::t('app', 'Op Company ID'),
            'markCompanyId' => Yii::t('app', 'Mark Company ID'),
            'aircraftId' => Yii::t('app', 'Aircraft ID'),
            'depCityId' => Yii::t('app', 'Dep City ID'),
            'arrCityId' => Yii::t('app', 'Arr City ID'),
            'supplierRef' => Yii::t('app', 'Supplier Ref'),
            'depTimestamp' => Yii::t('app', 'Dep Timestamp'),
            'arrTimestamp' => Yii::t('app', 'Arr Timestamp'),
        ];
    }
}
