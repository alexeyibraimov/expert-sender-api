<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Response\ActivitiesGetResponse;

use AlexeyIbraimov\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use AlexeyIbraimov\ExpertSenderApi\Model\ActivitiesGetResponse\ConfirmationActivity;
use AlexeyIbraimov\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with confirmation activities
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class ConfirmationsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get subscriptions
     *
     * @return ConfirmationActivity[]|iterable Subscriptions
     */
    public function getConfirmations(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new ConfirmationActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['ListId']),
                $row['ListName']
            );
        }
    }
}
