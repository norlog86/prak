<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rests;

/**
 * RestsSearch represents the model behind the search form of `app\models\Rests`.
 */
class RestsSearch extends Rests
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['str_id', 'art_id', 'rests_date', 'address'], 'safe'],
            [['rests'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Rests::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'rests_date' => $this->rests_date,
            'rests' => $this->rests,
            'str.address' => $this->str_id,
        ]);

        $query->andFilterWhere(['ilike', 'str_id', $this->str_id])
            ->andFilterWhere(['ilike', 'str.address', $this->str_id])
            ->andFilterWhere(['ilike', 'art_id', $this->art_id]);

        return $dataProvider;
    }
}
