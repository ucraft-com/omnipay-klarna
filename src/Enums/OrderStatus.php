<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Enums;

enum OrderStatus: string
{
    case AUTHORIZED = 'AUTHORIZED';
    case PART_CAPTURED = 'PART_CAPTURED';
    case CAPTURED = 'CAPTURED';
    case CANCELLED = 'CANCELLED';
    case EXPIRED = 'EXPIRED';
    case CLOSED = 'CLOSED';
}
