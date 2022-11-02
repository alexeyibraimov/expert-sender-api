<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Model\DataTablesGetDataPostRequest;

use AlexeyIbraimov\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Operator;

/**
 * Where condition
 *
 * @deprecated Use {@see \AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition} instead
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class WhereCondition extends \AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition
{
    /**
     * Constructor.
     *
     * @param string $columnName Column name
     * @param Operator $operator Operator
     * @param float|int|string $value Value
     */
    public function __construct($columnName, Operator $operator, $value)
    {
        @trigger_error('use \AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition instead', E_USER_DEPRECATED);

        parent::__construct($columnName, $operator, $value);
    }
}
