<?php

declare(strict_types=1);

namespace app\Module\Feedback\Command\Edit;

/**
 * Class EditFeedbackHandler
 * @package app\Module\Feedback\Command\Edit
 */
class EditFeedbackHandler
{
    /**
     * @param EditFeedbackCommand $command
     */
    public function handle(EditFeedbackCommand $command): void
    {
        $feedback = $command->getFeedback();
        $feedback->edit($command->getCustomer(), $command->getPhone(), $command->getStatus());
        $feedback->save();
    }
}
