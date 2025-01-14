<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Tests\Response;

use AlexeyIbraimov\ExpertSenderApi\Enum\SubscribersResponse\StateOnListStatus;
use AlexeyIbraimov\ExpertSenderApi\Enum\SubscriberPropertySource;
use AlexeyIbraimov\ExpertSenderApi\Enum\SubscribersResponse\SubscriberPropertyType;
use AlexeyIbraimov\ExpertSenderApi\Enum\DataType;
use AlexeyIbraimov\ExpertSenderApi\Model\SubscribersGetResponse\SubscriberProperty;
use AlexeyIbraimov\ExpertSenderApi\Response;
use AlexeyIbraimov\ExpertSenderApi\Response\SubscribersGetFullResponse;
use PHPUnit\Framework\Assert;

/**
 * SubscribersGetResponseTest
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class SubscribersGetResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testRealResponseParse()
    {
        $xml = file_get_contents(__DIR__ . '/subscribers_get_full_response.xml');

        $response = new SubscribersGetFullResponse(new Response(
            new \GuzzleHttp\Psr7\Response(200, [], $xml)
        ));
        Assert::assertFalse($response->isInBlackList());
        $stateOnLists = $response->getStateOnLists();
        Assert::assertCount(4, $stateOnLists);
        foreach ($stateOnLists as $stateOnList) {
            switch ($stateOnList->getListId()) {
                case 15:
                    Assert::assertEquals('Registration Registration', $stateOnList->getName());
                    Assert::assertTrue(StateOnListStatus::ACTIVE()->equals($stateOnList->getStatus()));
                    Assert::assertEquals(
                        '2014-11-12T11:27:05',
                        $stateOnList->getSubscriptionDate()->format('Y-m-d\TH:i:s')
                    );
                    break;
                case 143:
                    Assert::assertEquals('NOT_BY_BT', $stateOnList->getName());
                    Assert::assertTrue(StateOnListStatus::SNOOZED()->equals($stateOnList->getStatus()));
                    Assert::assertEquals(
                        '2015-11-03T19:31:22',
                        $stateOnList->getSubscriptionDate()->format('Y-m-d\TH:i:s')
                    );
                    break;
                case 153:
                    Assert::assertEquals('В2В_СС', $stateOnList->getName());
                    Assert::assertTrue(StateOnListStatus::UNSUBSCRIBED()->equals($stateOnList->getStatus()));
                    Assert::assertEquals(
                        '2015-11-24T10:32:50',
                        $stateOnList->getSubscriptionDate()->format('Y-m-d\TH:i:s')
                    );
                    break;
                case 157:
                    Assert::assertEquals('Corp. clients', $stateOnList->getName());
                    Assert::assertTrue(StateOnListStatus::NOT_CONFIRMED()->equals($stateOnList->getStatus()));
                    Assert::assertEquals(
                        '2015-11-27T13:41:06',
                        $stateOnList->getSubscriptionDate()->format('Y-m-d\TH:i:s')
                    );

                    break;
            }
        }

        $stopLists = $response->getSuppressionStopLists();
        Assert::assertCount(2, $stopLists);
        Assert::assertEquals([1 => 'Test list 1', 2 => 'Test list 2'], $stopLists);

        /** @var SubscriberProperty[] $properties */
        $properties = \iter\toArray($response->getSubscriberData()->getProperties());
        Assert::assertCount(5, $properties);

        Assert::assertEquals(1208798, $response->getSubscriberData()->getId());
        Assert::assertEquals('FIRSTNAME', $response->getSubscriberData()->getFirstname());
        Assert::assertEquals('ID905079', $response->getSubscriberData()->getLastname());
        Assert::assertEquals('есть', $response->getSubscriberData()->getVendor());
        Assert::assertEquals('92.242.35.180', $response->getSubscriberData()->getIp());

        foreach ($properties as $property) {
            switch ($property->getId()) {
                case 2:
                    Assert::assertTrue($property->getSource()->equals(SubscriberPropertySource::IMPORT()));
                    Assert::assertTrue($property->getValue()->getType()->equals(DataType::STRING()));
                    Assert::assertTrue($property->getType()->equals(SubscriberPropertyType::TEXT()));
                    Assert::assertEquals('russia_cl', $property->getValue()->getStringValue());
                    Assert::assertEquals('', $property->getValue()->getDefaultStringValue());
                    Assert::assertEquals('City', $property->getFriendlyName());
                    Assert::assertEquals('city', $property->getName());
                    Assert::assertEquals('City description', $property->getDescription());
                    break;
                case 3:
                    Assert::assertTrue($property->getSource()->equals(SubscriberPropertySource::PANEL()));
                    Assert::assertTrue($property->getValue()->getType()->equals(DataType::INTEGER()));
                    Assert::assertTrue($property->getType()->equals(SubscriberPropertyType::NUMBER()));
                    Assert::assertEquals(1, $property->getValue()->getIntValue());
                    Assert::assertEquals(2, $property->getValue()->getDefaultIntValue());
                    break;
                case 7:
                    Assert::assertTrue($property->getSource()->equals(SubscriberPropertySource::WEB()));
                    Assert::assertTrue($property->getValue()->getType()->equals(DataType::DATETIME()));
                    Assert::assertTrue($property->getType()->equals(SubscriberPropertyType::DATETIME()));
                    Assert::assertEquals(
                        '2017-05-16 11:11:11',
                        $property->getValue()->getDatetimeValue()->format('Y-m-d H:i:s')
                    );
                    Assert::assertEquals(
                        '2000-05-16 11:11:11',
                        $property->getValue()->getDefaultDatetimeValue()->format('Y-m-d H:i:s')
                    );
                    break;
                case 12:
                    Assert::assertTrue($property->getSource()->equals(SubscriberPropertySource::PREF_CENTER()));
                    Assert::assertTrue($property->getType()->equals(SubscriberPropertyType::MONEY()));
                    Assert::assertTrue($property->getValue()->getType()->equals(DataType::DECIMAL()));
                    Assert::assertEquals(
                        12.3,
                        $property->getValue()->getDecimalValue()
                    );
                    Assert::assertEquals(
                        14.5,
                        $property->getValue()->getDefaultDecimalValue()
                    );
                    break;
            }
        }
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testThrowExceptionIfTypeOfDataIsUnknown()
    {
        $xml = '<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema"
             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><Data><Properties>
            <Property>
                <Id>2</Id>
                <Source>Import</Source>
                <StringValue xsi:type="xsd:string">russia_cl</StringValue>
                <DataType>Unknown</DataType>
                <FriendlyName>City</FriendlyName>
                <Description>City description</Description>
                <Name>city</Name>
                <DefaultStringValue xsi:type="xsd:string"></DefaultStringValue>
            </Property></Properties></Data></ApiResponse>';
        $response = new SubscribersGetFullResponse(new Response(
            new \GuzzleHttp\Psr7\Response(200, [], $xml)
        ));
        \iter\toArray($response->getSubscriberData()->getProperties());
    }
}
