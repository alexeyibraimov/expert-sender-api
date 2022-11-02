<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\SnoozedSubscribersGetResponse\SnoozedSubscriber;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response of get snoozed subscribers request
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class SnoozedSubscribersGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get snoozed subscribers
     *
     * @return SnoozedSubscriber[]|iterable Snoozed subscribers
     */
    public function getSnoozedSubscribers(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/SnoozedSubscribers/SnoozedSubscriber');
        foreach ($nodes as $node) {
            yield new SnoozedSubscriber(
                strval($node->Email),
                intval($node->ListId),
                new \DateTime(strval($node->SnoozedUntil))
            );
        }
    }
}
