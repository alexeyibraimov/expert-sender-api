<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi;

/**
 * Expert Sender request sender
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
interface RequestSenderInterface
{
    /**
     * Send request
     *
     * @param RequestInterface $request Request
     *
     * @return ResponseInterface Response
     */
    public function send(RequestInterface $request): ResponseInterface;
}
