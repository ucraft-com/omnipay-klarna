<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Enums;

enum SessionStatus: string
{
    case WAITING = 'WAITING';
    case BACK = 'BACK';
    case IN_PROGRESS = 'IN_PROGRESS';
    case MANUAL_ID_CHECK = 'MANUAL_ID_CHECK';
    case COMPLETED = 'COMPLETED';
    case FAILED = 'FAILED';
    case DISABLED = 'DISABLED';
    case ERROR = 'ERROR';
    case CANCELLED = 'CANCELLED';
}
