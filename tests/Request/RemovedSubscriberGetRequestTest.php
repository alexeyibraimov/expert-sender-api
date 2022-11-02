<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Enum\RemovedSubscribersGetRequest\Option;
use AlexeyIbraimov\ExpertSenderApi\Enum\RemovedSubscribersGetRequest\RemoveType;
use AlexeyIbraimov\ExpertSenderApi\Request\RemovedSubscriberGetRequest;
use PHPUnit\Framework\Assert;

/**
 * RemovedSubscriberGetRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class RemovedSubscriberGetRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testQueryParams()
    {
        $request = new RemovedSubscriberGetRequest(
            [1, 2, 3],
            [RemoveType::API(), RemoveType::COMPLAINT()],
            new \DateTime('2017-10-01'),
            new \DateTime('2017-10-30'),
            Option::CUSTOMS()
        );

        Assert::assertEquals(
            [
                'listIds' => '1,2,3',
                'removeTypes' => 'Api,Complaint',
                'startDate' => '2017-10-01',
                'endDate' => '2017-10-30',
                'option' => 'Customs',
            ],
            $request->getQueryParams()
        );
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('/Api/RemovedSubscribers', $request->getUri());
        Assert::assertEmpty($request->toXml());
    }
}
