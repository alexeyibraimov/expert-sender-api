<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Enum\SubscribersResponse;

use MyCLabs\Enum\Enum;

/**
 * Subscriber's state on list status
 *
 * @method static StateOnListStatus UNSUBSCRIBED()
 * @method static StateOnListStatus ACTIVE()
 * @method static StateOnListStatus SNOOZED()
 * @method static StateOnListStatus NOT_CONFIRMED()
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
final class StateOnListStatus extends Enum
{
    /**
     * Unsubscribed
     */
    const UNSUBSCRIBED = 'Unsubscribed';

    /**
     * Active
     */
    const ACTIVE = 'Active';

    /**
     * Snoozed
     */
    const SNOOZED = 'Snoozed';

    /**
     * Not Confirmed
     */
    const NOT_CONFIRMED = 'NotConfirmed';
}
