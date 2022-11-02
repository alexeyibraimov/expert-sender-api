<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use AlexeyIbraimov\ExpertSenderApi\Request\TriggersPostRequest;
use PHPUnit\Framework\Assert;

/**
 * TriggersPostRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class TriggersPostRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new TriggersPostRequest(
            24,
            [
                Receiver::createFromEmail('mail@mail.com'),
                Receiver::createFromId(23),
            ]
        );

        $xml = '<Data xsi:type="TriggerReceivers"><Receivers><Receiver><Email>mail@mail.com</Email></Receiver>'
            . '<Receiver><Id>23</Id></Receiver></Receivers></Data>';
        Assert::assertEquals($xml, $request->toXml());
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/Api/Triggers/24', $request->getUri());
    }
}
