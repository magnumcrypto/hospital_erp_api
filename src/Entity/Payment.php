<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: 'payments')]
class Payment
{
    const CREDIT_CARD = 'credit_card';
    const CASH = 'cash';
    const TRANSFER = 'transfer';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(precision: 10, scale: 2, type: Types::DECIMAL)]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: 'payment_day')]
    private ?\DateTimeInterface $paymentDay = null;

    #[ORM\Column(length: 255, name: 'payment_method')]
    private ?string $paymentMethod = null;

    #[ORM\Column(name: 'created_at')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'updated_at')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'payments', targetEntity: Bills::class)]
    #[ORM\JoinColumn(nullable: false, name: 'id_bill', referencedColumnName: 'id')]
    private ?Bills $bill = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPaymentDay(): ?\DateTimeInterface
    {
        return $this->paymentDay;
    }

    public function setPaymentDay(\DateTimeInterface $paymentDay): static
    {
        $this->paymentDay = $paymentDay;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        if (!in_array($paymentMethod, [self::CREDIT_CARD, self::CASH, self::TRANSFER])) {
            throw new \InvalidArgumentException('Método de pago no válido');
        }
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBill(): ?Bills
    {
        return $this->bill;
    }

    public function setBill(?Bills $bill): static
    {
        $this->bill = $bill;

        return $this;
    }
}
