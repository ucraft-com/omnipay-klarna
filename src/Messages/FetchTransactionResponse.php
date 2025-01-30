<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

use Uc\Omnipay\Klarna\Enums\OrderStatus;

class FetchTransactionResponse extends AbstractResponse
{
    public function __construct(FetchTransactionRequest $request, array $data)
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
    public function getFraudStatus(): ?string
    {
        return $this->data['fraud_status'] ?? null;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        if ($this->getStatus() === OrderStatus::AUTHORIZED->value) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isCaptured(): bool
    {
        return $this->getStatus() === OrderStatus::CAPTURED->value;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->getStatus() === OrderStatus::CANCELLED->value;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->getStatus() === OrderStatus::CLOSED->value;
    }
}
