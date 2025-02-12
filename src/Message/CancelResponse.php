<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Message;

class CancelResponse extends AbstractResponse
{
    public function __construct(CancelRequest $request, array $data)
    {
        parent::__construct($request, $data);
    }
}
