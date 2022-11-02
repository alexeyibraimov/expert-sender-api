<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Request\GetSegmentSizeGetRequest;
use PHPUnit\Framework\Assert;

/**
 * GetSegmentSizeGetRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class GetSegmentSizeGetRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testCommonUsage()
    {
        $request = new GetSegmentSizeGetRequest(25);
        Assert::assertEquals(['id' => 25], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
        Assert::assertEquals('/Api/GetSegmentSize', $request->getUri());
    }
}
