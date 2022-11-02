<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Model\DataTablesGetDataPostRequest;

use AlexeyIbraimov\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Direction;
use Webmozart\Assert\Assert;

/**
 * Order by rule to get table data
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class OrderByRule
{
    /**
     * @var string Column name
     */
    private $columnName;

    /**
     * @var Direction Direction
     */
    private $direction;

    /**
     * Constructor
     *
     * @param string $columnName Column name
     * @param Direction $direction Sort order
     */
    public function __construct(string $columnName, Direction $direction)
    {
        Assert::notEmpty($columnName);
        $this->columnName = $columnName;
        $this->direction = $direction;
    }

    /**
     * Get column name
     *
     * @return string Column name
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * Get direction
     *
     * @return Direction Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }
}
