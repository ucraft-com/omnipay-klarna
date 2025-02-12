<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

class HPPSessionResponse extends AbstractResponse
{
    public function __construct(HPPSessionRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        return $this->data['redirect_url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSessionUrl(): ?string
    {
        return $this->data['session_url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getExpiresAt(): ?string
    {
        return $this->data['expires_at'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getQrCodeUrl(): ?string
    {
        return $this->data['qr_code_url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getDistributionUrl(): ?string
    {
        return $this->data['distribution_url'] ?? null;
    }

    /**
     * @return array|null
     */
    public function getDistributionModule(): ?array
    {
        return $this->data['distribution_module'] ?? null;
    }

    /**
     * @return string
     */
    public function getRedirectMethod(): string
    {
        return 'GET';
    }

    /**
     * @return bool
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['redirect_url'] = $this->getRedirectUrl();
            $response['session_id'] = $this->getSessionId();
            $response['session_url'] = $this->getSessionUrl();
            $response['expires_at'] = $this->getExpiresAt();
            $response['qr_code_url'] = $this->getQrCodeUrl();
            $response['distribution_url'] = $this->getDistributionUrl();
            $response['distribution_module'] = $this->getDistributionModule();
        }

        return $response;
    }
}
