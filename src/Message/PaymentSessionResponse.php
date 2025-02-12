<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

class PaymentSessionResponse extends AbstractResponse
{
    protected string|null $paymentSessionUrl = null;

    public function __construct(PaymentSessionRequest $request, array $data)
    {
        parent::__construct($request, $data);

        $this->setPaymentSessionUrl($request);
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
     * @param \Uc\Omnipay\Klarna\Message\PaymentSessionRequest $request
     *
     * @return void
     */
    public function setPaymentSessionUrl(PaymentSessionRequest $request): void
    {
        if ($this->isSuccessful()) {
            $this->paymentSessionUrl = $request->getEndpoint().'/'.$this->getSessionId() ?? null;
        }
    }

    /**
     * @return string|null
     */
    public function getPaymentSessionUrl(): ?string
    {
        return  $this->paymentSessionUrl;
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
