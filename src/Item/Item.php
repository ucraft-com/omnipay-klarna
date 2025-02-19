<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Item;

use Omnipay\Common\Item as baseItem;

final class Item extends baseItem implements ItemInterface
{
    /**
     * @param string $data
     */
    public function setMerchantData(string $data): void
    {
        $this->setParameter('merchant_data', $data);
    }

    /**
     * @return string|null
     */
    public function getMerchantData(): ?string
    {
        return $this->getParameter('merchant_data');
    }

    /**
     * @param float $taxRate
     */
    public function setTaxRate(float $taxRate): void
    {
        $this->setParameter('tax_rate', $taxRate);
    }

    /**
     * @return float|null
     */
    public function getTaxRate(): ?float
    {
        return $this->getParameter('tax_rate');
    }

    /**
     * @param float $amount
     */
    public function setTotalAmount(float $amount): void
    {
        $this->setParameter('total_amount', $amount);
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->getParameter('total_amount');
    }

    /**
     * @param float $amount
     */
    public function setTotalDiscountAmount(float $amount): void
    {
        $this->setParameter('total_discount_amount', $amount);
    }

    /**
     * @return float|null
     */
    public function getTotalDiscountAmount(): ?float
    {
        return $this->getParameter('total_discount_amount');
    }

    /**
     * @param float $amount
     */
    public function setTotalTaxAmount(float $amount): void
    {
        $this->setParameter('total_tax_amount', $amount);
    }

    /**
     * @return float|null
     */
    public function getTotalTaxAmount(): ?float
    {
        return $this->getParameter('total_tax_amount');
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->setParameter('type', $type);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->getParameter('type');
    }

    /**
     * @param float $unitPrice
     *
     * @return void
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->setParameter('unit_price', $unitPrice);
    }

    /**
     * @return float|null
     */
    public function getUnitPrice(): ?float
    {
        return $this->getParameter('unit_price');
    }
}
