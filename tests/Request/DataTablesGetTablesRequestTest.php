<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesGetTablesRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesGetTablesRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesGetTablesRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCreateWithTableName()
    {
        $request = new DataTablesGetTablesRequest('table-name');
        Assert::assertEquals(['name' => 'table-name'], $request->getQueryParams());
        Assert::assertEquals('/Api/DataTablesGetTables', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
    }

    /**
     * Test
     */
    public function testCreateWithoutTableName()
    {
        $request = new DataTablesGetTablesRequest(null);
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertEquals('/Api/DataTablesGetTables', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
    }
}
