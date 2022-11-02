<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Model\SubscribersPostResponse\SubscriberData;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;
use AlexeyIbraimov\ExpertSenderApi\Utils;

/**
 * Response of add/edit subscriber request
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class SubscribersPostResponse extends SpecificXmlMethodResponse
{
    /**
     * Get subscribers info after add/edit
     *
     * @return SubscriberData[] Subscribers info after add/edit
     */
    public function getChangedSubscribersData(): array
    {
        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/SubscriberData');
        $subscriberDataList = [];
        foreach ($nodes as $node) {
            $subscriberDataList[] = new SubscriberData(
                strval($node->Email),
                intval($node->Id),
                Utils::convertStringBooleanEquivalentToBool(strval($node->WasAdded)),
                Utils::convertStringBooleanEquivalentToBool(strval($node->WasIgnored))
            );
        }

        return $subscriberDataList;
    }
}
