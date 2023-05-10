<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

  public function test_commission_amount_is_10_cent_form_donation_of_100_cents_and_commission_of_10_percent()
  {
    // Etant donné une donation de 100 et commission de 10%
    $donationFees = new \App\Support\DonationFee(100, 10);

    // Lorsque qu'on appel la méthode getCommissionAmount()
    $actual = $donationFees->getCommissionAmount();

    // Alors la Valeur de la commission doit être de 10
    $expected = 10;
    $this->assertEquals($expected, $actual);
  }

  public function test_commission_amount_is_20_cents_form_donation_of_200_cents_and_commission_of_10_percent()
  {
    // Etant donné une donation de 200 et commission de 10%
    $donationFees = new \App\Support\DonationFee(200, 10);

    // Lorsque qu'on appel la méthode getCommissionAmount()
    $actual = $donationFees->getCommissionAmount();

    // Alors la Valeur de la commission doit être de 20
    $expected = 20;
    $this->assertEquals($expected, $actual);
  }

  public function test_commission_max()
  {
    // On s'attend à générer une erreur
    // expectExecption doit TOUJOURS se trouver avant la fonction qui génère l'erreur
    $this->expectException(\Exception::class);

    // La commission ne peux pas dépasser 30%
    $donationFees = new \App\Support\DonationFee(100, 40);
  }

  public function test_commission_min()
  {
    // On s'attend à générer une erreur
    $this->expectException(\Exception::class);

    // La commission ne peux pas être inférieure à 0%
    $donationFees = new \App\Support\DonationFee(100, -20);
  }

  public function test_donation_min()
  {
    // On s'attend à générer une erreur
    $this->expectException(\Exception::class);

    // On doit donner au moins 1 €, donc 50 cents est insuffisant 
    $donationFees = new \App\Support\DonationFee(50, 10);
  }

  public function test_fixed_and_comission_fee_amount()
  {
    // On donne 4 € avec une comission de 10%, ce qui fait 40 cents de commission
    $donationFees = new \App\Support\DonationFee(400, 10);

    // On récupère les frais fixes + variables
    $actual = $donationFees->getFixedAndCommissionFeeAmount();

    // On ajoute à 40 cents les 50 cents de frais fixes, on doit avoir 90 cents
    $expected = 90;
    $this->assertEquals($expected, $actual);
  }

  public function test_fixed_and_comission_max()
  {
    // On donne 30 € avec 20% de commission, ce qui fait 6 € de commission
    $donationFees = new \App\Support\DonationFee(3000, 20);

    // On récupère les frais fixes + variables
    $actual = $donationFees->getFixedAndCommissionFeeAmount();

    // Avec les frais fixes de 50 cents, on est à 6.50 €
    // Mais le maximum est de 5 €, on doit donc avoir 5 €
    $expected = 500;
    $this->assertEquals($expected, $actual);
  }

  public function test_donation_summary()
  {
    // On donne 10 € pour 20% de commission
    $donationFees = new \App\Support\DonationFee(1000, 20);

    // On récupère le résumé des frais
    $actual = $donationFees->getSummary();

    // Voici ce que l'on attend
    $expected = [
      'donation' => 1000,
      'fixedFee' => 50,
      'commission' => 200,
      'fixedAndCommission' => 250,
      'amountCollected' => 750
    ];

    $this->assertEquals($expected, $actual);
  }
}
