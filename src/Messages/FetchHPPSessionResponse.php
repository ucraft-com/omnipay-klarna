<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Uc\Omnipay\Klarna\Enums\SessionStatus;

class FetchHPPSessionResponse extends AbstractResponse
{
    public function __construct(FetchHPPSessionRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->data['status'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getAuthorizationToken(): ?string
    {
        return $this->data['authorization_token'] ?? null;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        if ($this->getStatus() === SessionStatus::COMPLETED->value) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->getStatus() === SessionStatus::FAILED->value;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->getStatus() === SessionStatus::CANCELLED->value;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['session_id'] = $this->getSessionId();
            $response['order_id'] = $this->getTransactionReference();
            $response['authorization_token'] = $this->getAuthorizationToken();
            $response['status'] = $this->getStatus();
        }

        return $response;
    }
}
