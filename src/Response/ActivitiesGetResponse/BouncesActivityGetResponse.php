<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response\ActivitiesGetResponse;

use AlexeyIbraimov\ExpertSenderApi\Enum\ActivitiesGetRequest\BounceReason;
use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\ActivitiesGetResponse\BounceActivity;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Bounces activity get response
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class BouncesActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get removal activities
     *
     * @return BounceActivity[]|iterable Removal activities
     */
    public function getBounces(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new BounceActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                new BounceReason($row['Reason']),
                $row['DiagnosticCode'],
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
