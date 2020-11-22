<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Create;

use yii\base\Model;

class CreateFeedbackForm extends Model
{
    public string $customer;
    public string $phone;
    public int $status;

    public function rules(): array
    {
        return [
            ['phone', 'required'],
            ['customer', 'string', 'length' => [0, 256]],
            ['phone', 'match', 'pattern' => '#^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$#', 'message' => 'Неверный формат телефона'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'customer' => 'ФИО',
            'phone' => 'Телефон'
        ];
    }
}
