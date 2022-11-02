<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response\ActivitiesGetResponse;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\ActivitiesGetResponse\ClickActivity;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with clicks activity
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class ClicksActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get open activities
     *
     * @return ClickActivity[]|iterable Open activities
     */
    public function getClicks(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new ClickActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                $row['Url'],
                $row['Title'],
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
