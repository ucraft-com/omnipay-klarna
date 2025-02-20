<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

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
     * @return bool
     */
    public function isCapture(): bool
    {
        return $this->getStatus() === OrderStatus::CAPTURED->value;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
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

    /**
     * @return int|null
     */
    public function getOrderAmount(): ?int
    {
        return $this->data['order_amount'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getFraudStatus(): ?string
    {
        return $this->data['fraud_status'] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['order_id'] = $this->getTransactionReference();
            $response['order_amount'] = $this->getOrderAmount();
            $response['fraud_status'] = $this->getFraudStatus();
            $response['status'] = $this->getStatus();
        }

        return $response;
    }
}
