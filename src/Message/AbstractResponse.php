<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

abstract class AbstractResponse extends BaseAbstractResponse
{
    public function __construct(AbstractRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->data['error_code'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        if (isset($this->data['error_message'])) {
            return $this->data['error_message'];
        }

        if (isset($this->data['error_messages'])) {
            return $this->data['error_messages'][0] ?? null;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['order_id'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->data['session_id'] ?? null;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return !isset($this->data['error_code']);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
