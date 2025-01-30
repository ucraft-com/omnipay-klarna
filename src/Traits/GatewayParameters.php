<?php

declare(strict_types=1);

namespace Uc\Omnipay\Klarna\Traits;

use InvalidArgumentException;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exception\ParserException;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

/**
 * Trait GatewayParameters
 */
trait GatewayParameters
{
    /**
     * @param string $region
     *
     * @return void
     */
    public function setRegion(string $region): void
    {
        $this->setParameter('region', $region);
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->getParameter('region');
    }

    /**
     * @param string $locale
     *
     * @return void
     */
    public function setLocale(string $locale): void
    {
        $this->setParameter('locale', $locale);
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->getParameter('locale');
    }

    /**
     * @param string $merchantReference
     *
     * @return void
     */
    public function setMerchantReference1(string $merchantReference): void
    {
        $this->setParameter('merchant_reference1', $merchantReference);
    }

    /**
     * @return string|null
     */
    public function getMerchantReference1(): ?string
    {
        return $this->getParameter('merchant_reference1');
    }

    /**
     * @param string $merchantReference
     *
     * @return void
     */
    public function setMerchantReference2(string $merchantReference): void
    {
        $this->setParameter('merchant_reference2', $merchantReference);
    }

    /**
     * @return string|null
     */
    public function getMerchantReference2(): ?string
    {
        return $this->getParameter('merchant_reference2');
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setTaxAmount(int $value): void
    {
        $this->setParameter('tax_amount', $value);
    }

    /**
     * @return \Money\Money|null
     */
    public function getTaxAmount(): ?Money
    {
        if (null === $amount = $this->getParameter('tax_amount')) {
            return null;
        }

        return $this->convertToMoney($amount);
    }

    /**
     * @param string $secret
     *
     * @return void
     */
    public function setSecret(string $secret): void
    {
        $this->setParameter('secret', $secret);
    }

    /**
     * @return string|null
     */
    public function getSecret(): ?string
    {
        return $this->getParameter('secret');
    }

    /**
     * @param string $username
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->setParameter('username', $username);
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->getParameter('username');
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setOrderAmount(int $value): void
    {
        $this->setParameter('order_amount', $value);
    }

    /**
     * @return int|null
     */
    public function getOrderAmount(): ?int
    {
        return $this->getParameter('order_amount');
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setAmount(int $value): void
    {
        $this->setParameter('amount', $value);
    }

    /**
     * @return Money|null
     */
    public function getAmount(): ?Money
    {
        if (null === $amount = $this->getParameter('amount')) {
            return null;
        }

        return $this->convertToMoney($amount);
    }

    /**
     * @param array $value
     *
     * @return void
     */
    public function setMerchantUrls(array $value): void
    {
        $this->setParameter('merchant_urls', $value);
    }

    /**
     * @return array|null
     */
    public function getMerchantUrls(): ?array
    {
        return $this->getParameter('merchant_urls');
    }

    public function setOrderLines(array $value): void
    {
        $this->setParameter('order_lines', $value);
    }

    /**
     * @return array|null
     */
    public function getOrderLines(): ?array
    {
        return $this->getParameter('order_lines');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setPurchaseCountry(string $value): void
    {
        $this->setParameter('purchase_country', $value);
    }

    /**
     * @return string|null
     */
    public function getPurchaseCountry(): ?string
    {
        return $this->getParameter('purchase_country');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setPurchaseCurrency(string $value): void
    {
        $this->setParameter('purchase_currency', $value);
    }

    /**
     * @return string|null
     */
    public function getPurchaseCurrency(): ?string
    {
        return $this->getParameter('purchase_currency');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setAuthorizationToken(string $value): void
    {
        $this->setParameter('authorization_token', $value);
    }

    /**
     * @return string|null
     */
    public function getAuthorizationToken(): ?string
    {
        return $this->getParameter('authorization_token');
    }

    /**
     * @param bool $value
     *
     * @return void
     */
    public function setTestMode(bool $value): void
    {
        $this->setParameter('testMode', $value);
    }

    /**
     * @return bool
     */
    public function getTestMode(): bool
    {
        return (bool)$this->getParameter('testMode');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setOrderMode(string $value): void
    {
        $this->setParameter('order_mode', $value);
    }

    /**
     * @return string|null
     */
    public function getOrderMode(): ?string
    {
        return $this->getParameter('order_mode');
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setOrderTaxAmount(int $value): void
    {
        $this->setParameter('order_tax_amount', $value);
    }

    /**
     * @return int|null
     */
    public function getOrderTaxAmount(): ?int
    {
        return $this->getParameter('order_tax_amount');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setSessionId(string $value): void
    {
        $this->setParameter('session_id', $value);
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->getParameter('session_id');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setOrderRef(string $value): void
    {
        $this->setParameter('order_ref', $value);
    }

    /**
     * @return string|null
     */
    public function getOrderRef(): ?string
    {
        return $this->getParameter('order_ref');
    }

    /**
     * @param array $value
     *
     * @return void
     */
    public function setBillingAddress(array $value): void
    {
        $this->setParameter('billing_address', $value);
    }

    /**
     * @return array|null
     */
    public function getBillingAddress(): ?array
    {
        return $this->getParameter('billing_address');
    }

    /**
     * @param array $value
     *
     * @return void
     */
    public function setDeliveryAddress(array $value): void
    {
        $this->setParameter('delivery_address', $value);
    }

    /**
     * @return array|null
     */
    public function getDeliveryAddress(): ?array
    {
        return $this->getParameter('delivery_address');
    }

    /**
     * @return bool
     */
    public function hasDeliveryAddress(): bool
    {
        return (bool)!empty($this->getDeliveryAddress());
    }

    /**
     * @return bool
     */
    public function hasOptions(): bool
    {
        return (bool)!empty($this->getOptions());
    }

    /**
     * @param array $value
     *
     * @return void
     */
    public function setOptions(array $value): void
    {
        $this->setParameter('options', $value);
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->getParameter('options');
    }

    /**
     * @param string $version
     *
     * @return void
     */
    public function setVersion(string $version): void
    {
        $this->setParameter('version', $version);
    }

    /**
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->getParameter('version');
    }

    /**
     * @param int $value
     *
     * @return void
     */
    public function setRefundAmount(int $value): void
    {
        $this->setParameter('refund_amount', $value);
    }

    /**
     * @return int|null
     */
    public function getRefundAmount(): ?int
    {
        return $this->getParameter('refund_amount');
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function setRefundReason(string $value): void
    {
        $this->setParameter('refund_reason', $value);
    }

    /**
     * @return string|null
     */
    public function getRefundReason(): ?string
    {
        return $this->getParameter('refund_reason');
    }

    /**
     * @param $amount
     *
     * @return \Money\Money
     */
    protected function convertToMoney($amount): Money
    {
        if ($amount instanceof Money) {
            return $amount;
        }

        try {
            $currency = new Currency($this->getCurrency());
        } catch (InvalidArgumentException) {
            $currency = new Currency('USD');
        }

        $moneyParser = new DecimalMoneyParser(new ISOCurrencies());

        return $moneyParser->parse((string)$amount, $currency);
    }

    /**
     * @param Money $money
     *
     * @return int
     *
     * @throws ParserException
     */
    protected function toCurrencyMinorUnits(Money $money): int
    {
        $moneyParser = new DecimalMoneyParser(new ISOCurrencies());

        return (int)$moneyParser->parse($money->getAmount(), $money->getCurrency())->getAmount();
    }
}
