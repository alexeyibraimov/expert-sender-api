<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with count info
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class CountResponse extends SpecificXmlMethodResponse
{
    /**
     * Get count
     *
     * @return int Count
     */
    public function getCount(): int
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return intval($this->getSimpleXml()->xpath('/ApiResponse/Count')[0]);
    }
}
