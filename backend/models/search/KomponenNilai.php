<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KomponenNilai as KomponenNilaiModel;

/**
 * KomponenNilai represents the model behind the search form of `app\models\KomponenNilai`.
 */
class KomponenNilai extends KomponenNilaiModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kelas_mata_pelajaran_id', 'excel'], 'integer'],
            [['komponen_nilai'], 'safe'],
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
        $query = KomponenNilaiModel::find();

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
            'id' => $this->id,
            'kelas_mata_pelajaran_id' => $this->kelas_mata_pelajaran_id,
            'excel' => $this->excel,
        ]);

        $query->andFilterWhere(['like', 'komponen_nilai', $this->komponen_nilai]);

        return $dataProvider;
    }
}
