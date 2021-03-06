<?php

declare(strict_types=1);

namespace app\Module\Feedback\Entity;

use yii\db\ActiveRecord;

/**
 * Class Feedback
 * @package Module\Feedback\Entity
 *
 * @property integer $id
 * @property string $customer
 * @property string $phone
 * @property integer $status
 */
class Feedback extends ActiveRecord
{
    public const STATUS_MODERATION = 0;
    public const STATUS_PROCESSED = 1;
    public const STATUS_REJECTED = 2;

    /**
     * @param string $customer
     * @param string $phone
     * @return static
     */
    public static function create(string $customer, string $phone): self
    {
        $feedback = new static();
        $feedback->customer = $customer;
        $feedback->phone = $phone;
        $feedback->status = self::STATUS_MODERATION;

        return $feedback;
    }

    /**
     * @param string $customer
     * @param string $phone
     * @param int $status
     */
    public function edit(string $customer, string $phone, int $status): void
    {
        $feedback = new static();
        $feedback->customer = $customer;
        $feedback->phone = $phone;
        $feedback->status = $status;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%feedbacks}}';
    }

    /**
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_MODERATION => 'На модерации',
            self::STATUS_PROCESSED => 'Обработана',
            self::STATUS_REJECTED => 'Отклонена'
        ];
    }
}
