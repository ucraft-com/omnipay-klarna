<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

class CaptureResponse extends AbstractResponse
{
    public function __construct(CaptureRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * @return string|null
     */
    public function getCaptureId(): ?string
    {
        return $this->data['capture_id'] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];

        if ($this->isSuccessful()) {
            $response['capture_id'] = $this->getCaptureId();
        }

        return $response;
    }
}
