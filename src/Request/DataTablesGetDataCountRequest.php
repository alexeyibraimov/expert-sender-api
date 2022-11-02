<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition;
use AlexeyIbraimov\ExpertSenderApi\RequestInterface;
use AlexeyIbraimov\ExpertSenderApi\Traits\WhereConditionToXmlConverterTrait;
use Webmozart\Assert\Assert;

/**
 * Request to get count of rows in table
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesGetDataCountRequest implements RequestInterface
{
    use WhereConditionToXmlConverterTrait;

    /**
     * @var string Table name
     */
    private $tableName;

    /**
     * @var WhereCondition[] Where conditions
     */
    private $whereConditions = [];

    /**
     * Constructor.
     *
     * @param string $tableName Table name
     * @param WhereCondition[]|array $whereConditions Where conditions
     */
    public function __construct(string $tableName, array $whereConditions)
    {
        Assert::notEmpty($tableName);
        Assert::allIsInstanceOf($whereConditions, WhereCondition::class);
        Assert::notEmpty($whereConditions);
        $this->tableName = $tableName;
        $this->whereConditions = $whereConditions;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->writeElement('TableName', $this->tableName);
        $xmlWriter->startElement('WhereConditions');
        foreach ($this->whereConditions as $whereCondition) {
            $this->convertWhereConditionToXml($whereCondition, $xmlWriter);
        }

        $xmlWriter->endElement(); // WhereConditions

        return $xmlWriter->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::POST();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/Api/DataTablesGetDataCount';
    }
}
