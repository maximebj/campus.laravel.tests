<?php

namespace App\Support;


class DonationFee
{
    private const FIXED_FEE = 50;

    private $donation;
    private $commissionPercentage;

    public function __construct(int $donation, int $commissionPercentage)
    {
        $this->donation = $donation;
        $this->commissionPercentage = $commissionPercentage;

        if ( $commissionPercentage < 0 || $commissionPercentage > 30 ) {
            throw new \Exception('Commission percentage must be between 0 and 30');
        }

        if ($donation < 100 ) {
            throw new \Exception('Donation must be at least 100');
        }
    }

    public function getCommissionAmount(): float
    {
        return $this->donation * $this->commissionPercentage / 100;
    }

    public function getAmountCollected(): float
    {
        return $this->donation - $this->getFixedAndCommissionFeeAmount();
    }

    public function getFixedAndCommissionFeeAmount(): float
    {
        $fixedAndCommissionFeeAmount = $this->getCommissionAmount() + self::FIXED_FEE;
        
        if ($fixedAndCommissionFeeAmount > 500) {
            return 500;
        }
        
        return $fixedAndCommissionFeeAmount;
    }

    /* *
     * @return array
     */
    public function getSummary(): array
    {
        return [
            'donation' => $this->donation,
            'fixedFee' => self::FIXED_FEE,
            'commission' => $this->getCommissionAmount(),
            'fixedAndCommission' => $this->getFixedAndCommissionFeeAmount(),
            'amountCollected' => $this->getAmountCollected()
        ];
    }
}