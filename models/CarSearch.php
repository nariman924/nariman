<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * CarSearch represents the model behind the search form about `app\models\Car`.
 */
class CarSearch extends Car
{
    public $from_year;
    public $to_year;
    public $from_price;
    public $to_price;
    public $slug;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'price', 'from_year', 'to_year', 'from_price', 'to_price'], 'integer'],
            [['slug'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'from_year' => Yii::t('app', 'From Year'),
            'to_year' => Yii::t('app', 'To Year'),
            'from_price' => Yii::t('app', 'From Price'),
            'to_price' => Yii::t('app', 'To Price'),
        ]);
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
        $query = Car::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['price','updated_at']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['categoryId' => $this->categoryId]);
        $query->andFilterWhere(['<=', 'year', $this->to_year]);
        $query->andFilterWhere(['>=', 'year', $this->from_year]);
        $query->andFilterWhere(['<=', 'price', $this->to_price]);
        $query->andFilterWhere(['>=', 'price', $this->from_price]);

        return $dataProvider;
    }
}
