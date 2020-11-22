<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Create;

use app\Module\Feedback\Entity\Feedback;

/**
 * Class CreateFeedbackHandler
 * @package Module\Feedback\Command\Create
 */
class CreateFeedbackHandler
{
    public function handle(CreateFeedbackCommand $command): void
    {
        $feedback = Feedback::create(
            $command->getCustomer(),
            $command->getPhone()
        );

        $feedback->save();
    }
}
