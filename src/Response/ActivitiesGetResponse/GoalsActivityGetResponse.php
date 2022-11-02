<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response\ActivitiesGetResponse;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\ActivitiesGetResponse\GoalActivity;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Goal activity get response
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class GoalsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get goal activities
     *
     * @return GoalActivity[]|iterable Goal activities
     */
    public function getGoals(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new GoalActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                intval($row['GoalValue']),
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
