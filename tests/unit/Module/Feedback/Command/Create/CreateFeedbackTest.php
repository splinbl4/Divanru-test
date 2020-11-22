<?php

declare(strict_types=1);

namespace unit\Module\Feedback\Command\Create;

use Codeception\Test\Unit;
use app\Module\Feedback\Command\Create\CreateFeedbackForm;

/**
 * Class CreateFeedbackTest
 * @package unit\Module\Feedback\Command\Create
 */
class CreateFeedbackTest extends Unit
{
    public function testSuccess(): void
    {
        $form = new CreateFeedbackForm();
        $form->attributes = [
            'customer' => '',
            'phone' => '+7(999)999-99-99'
        ];

        expect_that($form->validate(['customer', 'phone']));
    }

    public function testErrorPhoneFormat(): void
    {
        $form = new CreateFeedbackForm();
        $form->attributes = [
            'customer' => '',
            'phone' => '+7(999) 999-99-99'
        ];

        expect_not($form->validate());
        expect_that($form->getErrors('phone'));

        expect($form->getFirstError('phone'))
            ->equals('Неверный формат телефона');
    }

    public function testBlank(): void
    {
        $form = new CreateFeedbackForm();
        $form->attributes = [
            'customer' => '',
            'phone' => ''
        ];

        expect_not($form->validate());
        expect_that($form->getErrors('phone'));

        expect($form->getFirstError('phone'))
            ->equals('Необходимо заполнить «Телефон».');
    }
}
