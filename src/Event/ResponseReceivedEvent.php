<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Event;

use AlexeyIbraimov\ExpertSenderApi\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event after response received
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class ResponseReceivedEvent extends Event
{
    /**
     * @var ResponseInterface Response
     */
    private $response;

    /**
     * Constructor.
     *
     * @param ResponseInterface $response Response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Get response
     *
     * @return ResponseInterface Response
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
