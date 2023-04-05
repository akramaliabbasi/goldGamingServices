<?php

namespace app\modules\product\models;


use yii\base\Model;
use Yii;
use yii\data\ActiveDataProvider;
use app\modules\product\models\product as Product;


class ProductSearch extends Product
{
    public $createdBy;

    // ...

    public function rules()
    {
        return [
            // ...
            [['createdBy'], 'safe'],
        ];
    }

	public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
          //  ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
