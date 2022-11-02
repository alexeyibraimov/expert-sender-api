<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Model\Column;
use AlexeyIbraimov\ExpertSenderApi\Model\DataTablesAddMultipleRowsPostRequest\Row;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesAddMultipleRowsPostRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesAddMultipleRowsPostRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesAddMultipleRowsPostRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new DataTablesAddMultipleRowsPostRequest(
            'table-name', [
                new Row(
                    [
                        new Column('string', 'string'),
                        new Column('null', null),
                    ]
                ),
                new Row(
                    [
                        new Column('float', 5.67),
                        new Column('int', 12),
                    ]
                ),
            ]
        );

        $xml = '<TableName>table-name</TableName><Data><Row><Columns><Column><Name>string</Name><Value>string</Value>'
            . '</Column><Column><Name>null</Name><Value xsi:nil="true"/></Column></Columns></Row><Row><Columns>'
            . '<Column><Name>float</Name><Value>5.67</Value></Column><Column><Name>int</Name><Value>12</Value>'
            . '</Column></Columns></Row></Data>';
        Assert::assertEquals($xml, $request->toXml());
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/Api/DataTablesAddMultipleRows', $request->getUri());
    }
}
