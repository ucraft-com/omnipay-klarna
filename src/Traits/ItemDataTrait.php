<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Traits;

use Money\Money;
use Uc\Omnipay\Klarna\Item\ItemBag;

trait ItemDataTrait
{
    /**
     * @param ItemBag $items
     *
     * @return array[]
     */
    public function getItemData(ItemBag $items): array
    {
        $orderLines = [];

        foreach ($items as $item) {
            $totalTaxAmount = $this->convertToMoney($item->getTotalTaxAmount());
            $totalDiscountAmount = $this->convertToMoney($item->getTotalDiscountAmount());
            $totalAmount = $this->convertToMoney($item->getTotalAmount());
            $unitPrice = $this->convertToMoney($item->getUnitPrice());

            $orderLines[] = [
                'reference'             => $item->getReference(),
                'type'                  => $item->getType(),
                'name'                  => $item->getName(),
                'quantity'              => $item->getQuantity(),
                'tax_rate'              => (int)($item->getTaxRate() * 100),
                'unit_price'            => (int)$unitPrice->getAmount(),
                'total_amount'          => (int)$totalAmount->getAmount(),
                'total_discount_amount' => (int)$totalDiscountAmount->getAmount(),
                'total_tax_amount'      => (int)$totalTaxAmount->getAmount(),
                'merchant_data'         => $item->getMerchantData(),
            ];
        }

        return $orderLines;
    }

    abstract protected function convertToMoney($amount): Money;
}
