<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Enum\DataTablesGetDataPostRequest;

use MyCLabs\Enum\Enum;

/**
 * Sort Order
 *
 * @method static Direction ASCENDING()
 * @method static Direction DESCENDING()
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
final class Direction extends Enum
{
    /**
     * Ascending
     */
    const ASCENDING = 'Ascending';

    /**
     * Descending
     */
    const DESCENDING = 'Descending';
}
