<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Edit;

use app\Module\Feedback\Entity\Feedback;
use yii\base\Model;

/**
 * Class EditFeedbackForm
 * @package app\Module\Feedback\Command\Edit
 */
class EditFeedbackForm extends Model
{
    public string $customer;
    public string $phone;
    public int $status;

    public function __construct(Feedback $feedback, $config = [])
    {
        $this->customer = $feedback->customer;
        $this->phone = $feedback->phone;
        $this->status = $feedback->status;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'status'], 'required'],
            ['customer', 'string', 'max' => 256],
            ['phone', 'match', 'pattern' => '#^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$#', 'message' => 'Неверный формат телефона'],
            ['accrual_receipt_amount_mode', 'in', 'range' => array_keys(Feedback::statusList()), 'message' => 'Статус должен быть выбран'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'customer' => 'ФИО',
            'phone' => 'Телефон',
            'status' => 'Статус'
        ];
    }
}
