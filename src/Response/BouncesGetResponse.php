<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response;

use AlexeyIbraimov\ExpertSenderApi\Enum\BouncesGetResponse\BounceType;
use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\BouncesGetResponse\Bounce;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Bounces data
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class BouncesGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get bounces
     *
     * @return Bounce[]|\Generator Bounces
     */
    public function getBounces(): \Generator
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new Bounce(
                new \DateTime($row['Date']),
                $row['Email'],
                $row['BounceCode'],
                new BounceType($row['BounceType'])
            );
        }
    }
}
