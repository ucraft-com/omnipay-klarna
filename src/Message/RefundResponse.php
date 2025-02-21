<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

class RefundResponse extends AbstractResponse
{
    public function __construct(RefundRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return array|null
     */
    public function getRefundId(): ?array
    {
        return $this->data['refund_id'] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['refund_id'] = $this->getRefundId();
        }

        return $response;
    }
}
