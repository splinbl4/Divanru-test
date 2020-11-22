<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Create;

/**
 * Class RequestCommand
 * @package Module\Feedback\Command\Create
 */
class CreateFeedbackCommand
{
    private ?string $customer;
    private string $phone;

    /**
     * CreateFeedbackCommand constructor.
     * @param string|null $customer
     * @param string $phone
     */
    public function __construct(?string $customer, string $phone)
    {
        $this->customer = $customer;
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getCustomer(): ?string
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
}
