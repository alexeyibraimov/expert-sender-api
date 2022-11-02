<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Resource;

use AlexeyIbraimov\ExpertSenderApi\AbstractResource;
use AlexeyIbraimov\ExpertSenderApi\Model\Column;
use AlexeyIbraimov\ExpertSenderApi\Model\DataTablesAddMultipleRowsPostRequest\Row;
use AlexeyIbraimov\ExpertSenderApi\Model\DataTablesDeleteRowsPostRequest\Filter;
use AlexeyIbraimov\ExpertSenderApi\Model\DataTablesGetDataPostRequest\OrderByRule;
use AlexeyIbraimov\ExpertSenderApi\Model\WhereCondition;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesAddMultipleRowsPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesClearTableRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesDeleteRowPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesDeleteRowsPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesGetDataCountRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesGetDataPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesGetTablesRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesUpdateRowPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Response\CountResponse;
use AlexeyIbraimov\ExpertSenderApi\Response\DataTablesGetTablesDetailsResponse;
use AlexeyIbraimov\ExpertSenderApi\Response\DataTablesGetTablesSummaryResponse;
use AlexeyIbraimov\ExpertSenderApi\ResponseInterface;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Data tables resource
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesResource extends AbstractResource
{
    /**
     * Add rows to table
     *
     * @param string $tableName Table name
     * @param Row[]|iterable $rows Rows
     *
     * @return ResponseInterface Response
     */
    public function addRows(string $tableName, iterable $rows): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesAddMultipleRowsPostRequest($tableName, $rows));
    }

    /**
     * Get table rows
     *
     * @param string $tableName Table name
     * @param string[] $columnNames Column names
     * @param WhereCondition[] $whereConditions Where conditions
     * @param OrderByRule[] $orderByRules Order by rules
     * @param int $limit Limit
     *
     * @return SpecificCsvMethodResponse Response
     */
    public function getRows(
        string $tableName,
        array $columnNames = [],
        array $whereConditions = [],
        array $orderByRules = [],
        $limit = null
    ): SpecificCsvMethodResponse {
        return new SpecificCsvMethodResponse(
            $this->requestSender->send(
                new DataTablesGetDataPostRequest($tableName, $columnNames, $whereConditions, $orderByRules, $limit)
            )
        );
    }

    /**
     * Update rows
     *
     * @param string $tableName Table name
     * @param Column[] $primaryKeyColumns Primary key columns. Collection of Column elements. Contains unique
     *      identifier (PK, primary key) of the row that is supposed to be updated. This is an equivalent of
     *      SQL "WHERE" directive
     * @param Column[] $columns Columns. Collection of Column elements. Contains information about columns that are
     *      supposed to be updated and their new values. This is an equivalent of SQL "SET" directive
     *
     * @return ResponseInterface Response
     */
    public function updateRow(string $tableName, array $primaryKeyColumns, array $columns): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesUpdateRowPostRequest($tableName, $primaryKeyColumns, $columns));
    }

    /**
     * Delete one row
     *
     * @param string $tableName Table name
     * @param Column[] $primaryKeyColumns Primary key columns. Collection of Column elements. Contains unique
     *      identifier (PK, primary key) of the row that is supposed to be deleted. This is an equivalent of SQL
     *      "WHERE" directive
     *
     * @return ResponseInterface Response
     */
    public function deleteOneRow(string $tableName, array $primaryKeyColumns): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesDeleteRowPostRequest($tableName, $primaryKeyColumns));
    }

    /**
     * Delete rows
     *
     * @param string $tableName Table name
     * @param Filter[] $filters Filters. This is an equivalent of SQL "WHERE" directive
     *
     * @return CountResponse Response
     */
    public function deleteRows(string $tableName, array $filters): CountResponse
    {
        return new CountResponse(
            $this->requestSender->send(new DataTablesDeleteRowsPostRequest($tableName, $filters))
        );
    }

    /**
     * Clear table
     *
     * @param string $tableName Table name
     *
     * @return ResponseInterface Response
     */
    public function clearTable(string $tableName): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesClearTableRequest($tableName));
    }

    /**
     * Get count of rows in table
     *
     * @param string $tableName Table name
     * @param array $whereConditions Where conditions
     *
     * @return CountResponse Response
     */
    public function getRowsCount(string $tableName, array $whereConditions): CountResponse
    {
        return new CountResponse(
            $this->requestSender->send(new DataTablesGetDataCountRequest($tableName, $whereConditions))
        );
    }

    /**
     * Get list of tables
     *
     * @return DataTablesGetTablesSummaryResponse Response with tables summary
     */
    public function getTablesList(): DataTablesGetTablesSummaryResponse
    {
        return new DataTablesGetTablesSummaryResponse(
            $this->requestSender->send(new DataTablesGetTablesRequest(null))
        );
    }

    /**
     * Get details of table
     *
     * @param string $tableName Table name
     *
     * @return DataTablesGetTablesDetailsResponse Response with details of table
     */
    public function getTableDetails($tableName): DataTablesGetTablesDetailsResponse
    {
        return new DataTablesGetTablesDetailsResponse(
            $this->requestSender->send(new DataTablesGetTablesRequest($tableName))
        );
    }
}
