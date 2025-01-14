<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Request;

use AlexeyIbraimov\ExpertSenderApi\Enum\HttpMethod;
use AlexeyIbraimov\ExpertSenderApi\Enum\SubscribersGetRequest\DataOption;
use AlexeyIbraimov\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Request for get subscriber info
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class SubscribersGetRequest implements RequestInterface
{
    /**
     * @var string Email
     */
    private $email;

    /**
     * @var DataOption DataType of response
     */
    private $option;

    /**
     * Constructor
     *
     * @param string $email Email
     * @param DataOption $option DataType of response
     */
    public function __construct(string $email, DataOption $option)
    {
        Assert::notEmpty($email);
        $this->email = $email;
        $this->option = $option;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/Api/Subscribers';
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return ['email' => $this->email, 'option' => $this->option->getValue()];
    }
}
