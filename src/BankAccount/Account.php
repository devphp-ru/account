<?php
declare(strict_types=1);

namespace App\BankAccount;

class Account
{
    private float $balance = 0;

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $sum
     */
    public function deposit(float $sum): void
    {
        $this->balance += $sum;
    }

    /**
     * @param float $sum
     */
    public function substractAmount(float $sum): void
    {
        $this->balance -= $sum;
    }

    /**
     * @param Account $destination
     * @param $sum
     * @throws \Exception
     */
    public function transferFunds(Account $destination, $sum): void
    {
        $this->isStateBalance($sum);
        $destination->deposit($sum);
        $this->substractAmount($sum);
    }

    /**
     * @param float $sum
     * @throws \Exception
     */
    private function isStateBalance(float $sum)
    {
        if ($this->getBalance() - $sum < 0) {
            throw new \Exception(sprintf(
                'Недостаточно средств: %1.2f',
                $this->getBalance()
            ));
        }
    }
}
