<?php
declare(strict_types=1);

namespace AlexeyIbraimov\ExpertSenderApi\Resource;

use AlexeyIbraimov\ExpertSenderApi\AbstractResource;
use AlexeyIbraimov\ExpertSenderApi\Model\TransactionalPostRequest\Attachment;
use AlexeyIbraimov\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use AlexeyIbraimov\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use AlexeyIbraimov\ExpertSenderApi\Model\TransactionalPostRequest\Receiver as TransactionalReceiver;
use AlexeyIbraimov\ExpertSenderApi\Request\TransactionalPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Request\TriggersPostRequest;
use AlexeyIbraimov\ExpertSenderApi\Response\TransactionalPostResponse;
use AlexeyIbraimov\ExpertSenderApi\ResponseInterface;

/**
 * Messages resource
 *
 * @author Nikita Sapogov <sapogov.n@alexeyibraimov.ru>
 */
class MessagesResource extends AbstractResource
{
    /**
     * Send trigger message
     *
     * @param int $triggerMessageId Trigger message ID
     * @param Receiver[] $receivers Receivers
     *
     * @return ResponseInterface Response
     */
    public function sendTriggerMessage(int $triggerMessageId, array $receivers): ResponseInterface
    {
        return $this->requestSender->send(new TriggersPostRequest($triggerMessageId, $receivers));
    }

    /**
     * Send transactional message
     *
     * @param int $transactionMessageId Transaction message ID
     * @param TransactionalReceiver $receiver Receiver
     * @param Snippet[] $snippets Snippets
     * @param Attachment[] $attachments Attachments
     * @param bool $returnGuid Should return GUID in Response
     *
     * @return TransactionalPostResponse Response
     */
    public function sendTransactionalMessage(
        int $transactionMessageId,
        TransactionalReceiver $receiver,
        array $snippets = [],
        array $attachments = [],
        bool $returnGuid = false
    ): TransactionalPostResponse {
        return new TransactionalPostResponse(
            $this->requestSender->send(
                new TransactionalPostRequest(
                    $transactionMessageId, $receiver, $snippets, $attachments, $returnGuid
                )
            )
        );
    }
}
