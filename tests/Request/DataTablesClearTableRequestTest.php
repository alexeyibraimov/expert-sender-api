<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Request\DataTablesClearTableRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesClearTableRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class DataTablesClearTableRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new DataTablesClearTableRequest('table-name');
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertEquals('/Api/DataTablesClearTable', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('<TableName>table-name</TableName>', $request->toXml());
    }
}
