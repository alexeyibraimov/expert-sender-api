<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with information of Segment
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class GetSegmentSizeGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get size of segment
     *
     * @return int Size of segment
     */
    public function getSize(): int
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return intval($this->getSimpleXml()->xpath('/ApiResponse/Data/Size')[0]);
    }

    /**
     * Get date of last segment size recalculation
     *
     * @return \DateTime Date of last segment size recalculation
     */
    public function getCountDate(): \DateTime
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return new \DateTime(strval($this->getSimpleXml()->xpath('/ApiResponse/Data/CountDate')[0]));
    }
}
