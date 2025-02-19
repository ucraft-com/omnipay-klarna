<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Structs;

final class Customer extends \ArrayObject
{
    /**
     * @param array $data
     *
     * @return Customer
     */
    public static function fromArray(array $data): Customer
    {
        $defaults = [
            'date_of_birth' => null,
            'type'          => 'person',
        ];

        return new self(array_merge($defaults, array_intersect_key($data, $defaults)));
    }
}
