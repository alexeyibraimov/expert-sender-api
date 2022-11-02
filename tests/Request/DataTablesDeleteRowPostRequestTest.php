<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Model\Column;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesDeleteRowPostRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesDeleteRowPostRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesDeleteRowPostRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new DataTablesDeleteRowPostRequest(
            'table-name',
            [
                new Column('Column1', 12),
                new Column('Column2', 12.5),
                new Column('Column3', 'string'),
            ]
        );

        $xml = '<TableName>table-name</TableName><PrimaryKeyColumns><Column><Name>Column1</Name><Value>12</Value>'
            . '</Column><Column><Name>Column2</Name><Value>12.5</Value></Column><Column><Name>Column3</Name>'
            . '<Value>string</Value></Column></PrimaryKeyColumns>';
        Assert::assertEquals($xml, $request->toXml());
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/Api/DataTablesDeleteRow', $request->getUri());
    }
}
