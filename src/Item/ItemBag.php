<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Item;

/**
 * @final
 * @method ItemInterface[] getIterator()
 */
class ItemBag extends \Omnipay\Common\ItemBag
{
    /**
     * @inheritDoc
     */
    public function add($item): void
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new Item($item);
        }
    }
}
