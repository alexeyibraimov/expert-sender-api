<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\ActivitiesGetRequest\ActivityType;
use AlexeyIbraimov\ExpertSenderApi\Enum\ActivitiesGetRequest\ReturnColumnsSet;
use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Request\ActivitiesGetRequest;
use PHPUnit\Framework\Assert;

/**
 * ActivitiesGetRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class ActivitiesGetRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new ActivitiesGetRequest(
            new \DateTime('2017-05-27'),
            ActivityType::COMPLAINTS(),
            ReturnColumnsSet::EXTENDED(),
            true,
            true
        );

        Assert::assertEquals('/Api/Activities', $request->getUri());
        Assert::assertEquals(
            [
                'date' => '2017-05-27',
                'type' => 'Complaints',
                'columns' => 'Extended',
                'returnTitle' => 'true',
                'returnGuid' => 'true',
            ],
            $request->getQueryParams()
        );
        Assert::assertEquals('', $request->toXml());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
    }
}
