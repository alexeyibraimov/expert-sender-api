<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\DataTablesGetTablesSummaryResponse\TableSummary;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with tables summary
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesGetTablesSummaryResponse extends SpecificXmlMethodResponse
{
    /**
     * Get tables
     *
     * @return TableSummary[]|iterable Tables
     */
    public function getTables(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $xml = $this->getSimpleXml();
        $nodes = $xml->xpath('/ApiResponse/TableList/Tables/Table');
        foreach ($nodes as $node) {
            yield new TableSummary(
                intval($node->Id),
                strval($node->Name),
                intval($node->ColumnsCount),
                intval($node->RelationshipsCount),
                intval($node->RelationshipsDestinationCount),
                intval($node->Rows),
                floatval($node->Size)
            );
        }
    }
}
