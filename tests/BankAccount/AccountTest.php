<?php
declare(strict_types=1);

namespace BankAccount;


use App\BankAccount\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    private Account $source;
    private Account $destination;

    private function bankAccount(): Account
    {
        return new Account();
    }

    private function init()
    {
        $this->source = $this->bankAccount();
        $this->source->deposit(200.00);

        $this->destination = $this->bankAccount();
        $this->destination->deposit(150.00);
    }

    public function testBankAccount()
    {
        $this->init();
        $this->source->transferFunds($this->destination, 100.00);
        self::assertEquals(250.00, $this->destination->getBalance());
        self::assertEquals(100.00, $this->source->getBalance());
    }

    public function testNotEnoughMoney()
    {
        $this->init();
        self::expectExceptionMessage('Недостаточно средств: 200');
        $this->source->transferFunds($this->destination, 300.00);
    }

    public function testTransferErrorBalance()
    {
        $this->init();

        try {
            $this->source->transferFunds($this->destination, 300.00);
        } catch (\Exception $e) {

        }

        self::assertEquals(150.00, $this->destination->getBalance());
        self::assertEquals(200.00, $this->source->getBalance());
    }
}
