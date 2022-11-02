<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response of POST request in transactions resource
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class TransactionalPostResponse extends SpecificXmlMethodResponse
{
    /**
     * Get GUID of sent message
     *
     * This GUID only shows when set returnGuid=true in {@see PostTransactionalRequest}
     *
     * @return string|null GUID of sent message
     */
    public function getGuid(): ?string
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $matches = [];
        if (preg_match('#<Data>(.*)</Data>#', $this->getContent(), $matches)) {
            return $matches[1];
        }

        return null;
    }
}
