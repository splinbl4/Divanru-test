<?php

declare(strict_types=1);

namespace app\Module\Feedback\Forms;

use app\Module\Feedback\Entity\Feedback;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class FeedbackSearch
 * @package app\Module\Feedback\Forms
 */
class FeedbackSearch extends Model
{
    public int $id;
    public string $customer;
    public string $phone;
    public int $status;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['customer', 'phone'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Feedback::find()->alias('f');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query
            ->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
