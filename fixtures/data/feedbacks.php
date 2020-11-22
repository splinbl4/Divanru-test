<?php

declare(strict_types=1);

use app\Module\Feedback\Entity\Feedback;

return [
    [
        'customer' => 'divan',
        'phone' => '+7(999)999-99-99',
        'status' => Feedback::STATUS_MODERATION
    ],
    [
        'customer' => 'anonymous',
        'phone' => '+0(000)000-00-00',
        'status' => Feedback::STATUS_MODERATION
    ]
];
