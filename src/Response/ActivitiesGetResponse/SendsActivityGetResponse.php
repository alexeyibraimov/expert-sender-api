<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response\ActivitiesGetResponse;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\ActivitiesGetResponse\SendActivity;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with sends activity
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class SendsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get send activities
     *
     * @return SendActivity[]|iterable Send activities
     */
    public function getSends(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new SendActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
