<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Item;

interface ItemInterface extends \Omnipay\Common\ItemInterface
{
    /**
     * @return string|null
     */
    public function getMerchantData(): ?string;

    /**
     * Non-negative percentage (i.e. 25 = 25%)
     *
     * @return float|null
     */
    public function getTaxRate(): ?float;

    /**
     * Total amount
     *
     * @return float|null
     */
    public function getTotalAmount(): ?float;

    /**
     * Total amount of discount
     *
     * @return float|null
     */
    public function getTotalDiscountAmount(): ?float;

    /**
     * Total amount of tax
     *
     * @return float|null
     */
    public function getTotalTaxAmount(): ?float;

    /**
     * Product type
     *
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @return float|null
     */
    public function getUnitPrice(): ?float;

    /**
     * @return string|null
     */
    public function getReference(): ?string;
}
