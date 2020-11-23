<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Edit;

use app\Module\Feedback\Entity\Feedback;

class EditFeedbackCommand
{
    private Feedback $feedback;
    private string $customer;
    private string $phone;
    private int $status;

    /**
     * EditFeedbackCommand constructor.
     * @param Feedback $feedback
     * @param string $customer
     * @param string $phone
     * @param int $status
     */
    public function __construct(Feedback $feedback, string $customer, string $phone, int $status)
    {
        $this->feedback = $feedback;
        $this->customer = $customer;
        $this->phone = $phone;
        $this->status = $status;
    }

    /**
     * @return Feedback
     */
    public function getFeedback(): Feedback
    {
        return $this->feedback;
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
