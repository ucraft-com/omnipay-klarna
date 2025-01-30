<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Messages;

class CreateSessionResponse extends AbstractResponse
{
    public function __construct(CreateSessionRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getClientToken(): ?string
    {
        return $this->data['client_token'] ?? null;
    }

    /**
     * @return array|null
     */
    public function getPaymentMethodCategories(): ?array
    {
        return $this->data['payment_method_categories'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPaymentSessionUrl(): ?string
    {
        return $this->data['payment_session_url'] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['session_id'] = $this->getSessionId();
            $response['client_token'] = $this->getClientToken();
            $response['payment_method_categories'] = $this->getPaymentMethodCategories();
            $response['payment_session_url'] = $this->getPaymentSessionUrl();
        }

        return $response;
    }
}
