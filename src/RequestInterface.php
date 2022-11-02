<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;

/**
 * ExpertSender API Response
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
interface RequestInterface
{
    /**
     * Get XML representation
     *
     * @return string XML representation
     */
    public function toXml(): string;

    /**
     * Get query parameters
     *
     * @return mixed[] Query parameters
     */
    public function getQueryParams(): array;

    /**
     * Get HTTP method
     *
     * @return HttpMethod HTTP method
     */
    public function getMethod(): HttpMethod;

    /**
     * Get URI
     *
     * @return string URI
     */
    public function getUri(): string;
}
