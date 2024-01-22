<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Wallet;

class WalletTest extends TestCase
{
    public function testBalanceIsInitiallyZero(): void
    {
        $wallet = new Wallet('USD');
        $this->assertEquals(0, $wallet->getBalance());
    }

    public function testAddingFundsIncreasesBalance(): void
    {
        $wallet = new Wallet('USD');
        $wallet->addFund(50);
        $this->assertEquals(50, $wallet->getBalance());
    }

    public function testRemovingFundsDecreasesBalance(): void
    {
        $wallet = new Wallet('USD');
        $wallet->addFund(50);
        $wallet->removeFund(20);
        $this->assertEquals(30, $wallet->getBalance());
    }

    public function testRemovingMoreFundsThanAvailableThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet('USD');
        $wallet->addFund(50);
        $wallet->removeFund(60);
    }

    public function testAddingNegativeFundsThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet('USD');
        $wallet->addFund(-50);
    }

    public function testRemovingNegativeFundsThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet('USD');
        $wallet->addFund(50);
        $wallet->removeFund(-20);
    }

    public function testSettingInvalidCurrencyThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $wallet = new Wallet('INVALID');
    }

    public function testSettingValidCurrency(): void
    {
        $wallet = new Wallet('USD');
        $this->assertEquals('USD', $wallet->getCurrency());
    }
}