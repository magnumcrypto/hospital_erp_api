<?php

namespace App\Entity;

use App\Repository\MedicalHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalHistoryRepository::class)]
#[ORM\Table(name: 'medical_histories')]
class MedicalHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: 'visit_date')]
    private ?\DateTimeInterface $visitDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diagnosis = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $treatment = null;

    #[ORM\Column(name: 'created_at')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'updated_at')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'medicalHistories', targetEntity: Patient::class)]
    #[ORM\JoinColumn(nullable: false, name: 'id_patient', referencedColumnName: 'id')]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'medicalHistories', targetEntity: Doctor::class)]
    #[ORM\JoinColumn(nullable: false, name: 'id_doctor', referencedColumnName: 'id')]
    private ?Doctor $doctor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->visitDate;
    }

    public function setVisitDate(\DateTimeInterface $visitDate): static
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    public function getDiagnosis(): ?string
    {
        return $this->diagnosis;
    }

    public function setDiagnosis(string $diagnosis): static
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(string $treatment): static
    {
        $this->treatment = $treatment;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): static
    {
        $this->doctor = $doctor;

        return $this;
    }
}
