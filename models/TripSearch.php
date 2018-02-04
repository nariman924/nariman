<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trip;
use yii\db\ActiveQuery;

/**
 * TripSearch represents the model behind the search form about `app\models\Trip`.
 */
class TripSearch extends Trip
{
    const CORP_ID = 3;
    const SERVICE_ID = 2;

    public $airport = 'Домодедово, Москва';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['airport'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Trip::find()
            ->distinct()
            ->alias('t')
            ->where(['t.corporate_id' => self::CORP_ID])
            ->innerJoinWith([
                'tripServices' => function ($query) {
                    /** @var ActiveQuery $query */
                    $query->from(['ts' => TripService::tableName()]);
                    $query->andWhere(['service_id' => self::SERVICE_ID]);
                },
            ], false);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->airport) {
            $query->leftJoin(
                ['fs' => FlightSegment::tableName()],
                "ts.id = fs.flight_id"
            )->leftJoin(
                ['an' => AirportName::tableName()],
                "fs.depAirportId = an.airport_id"
            )->andFilterWhere([
                'an.value' => $this->airport,
            ]);
        }

        $query->groupBy('t.id');

        return $dataProvider;
    }
}
