<?php

declare(strict_types=1);

namespace app\fixtures;

use yii\test\ActiveFixture;

/**
 * Class FeedbackFixture
 */
class FeedbackFixture extends ActiveFixture
{
    /**
     * @var string
     */
    public $modelClass = 'app\Module\Feedback\Entity\Feedback';
}
