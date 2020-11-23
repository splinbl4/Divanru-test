<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Create;

use yii\base\Model;

/**
 * Class CreateFeedbackForm
 * @package app\Module\Feedback\Command\Create
 */
class CreateFeedbackForm extends Model
{
    public string $customer;
    public string $phone;

    public function rules(): array
    {
        return [
            ['phone', 'required'],
            ['customer', 'string', 'max' => 256],
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
