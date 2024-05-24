<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ORM\Table(name: 'patients')]
class Patient
{
    const MALE_GENDER = 'masculino';
    const FEMALE_GENDER = 'femenino';
    const OTHER = 'otro';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $surnames = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: 'birth_date')]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 15, name: 'phone_number')]
    private ?string $phoneNumber = null;

    #[ORM\Column(name: 'created_at')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'updated_at')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'patient', cascade: ['persist', 'remove'])]
    private ?User $usuario = null;

    /**
     * @var Collection<int, Bills>
     */
    #[ORM\OneToMany(targetEntity: Bills::class, mappedBy: 'patient')]
    private Collection $bills;

    /**
     * @var Collection<int, MedicalHistory>
     */
    #[ORM\OneToMany(targetEntity: MedicalHistory::class, mappedBy: 'patient')]
    private Collection $medicalHistories;

    /**
     * @var Collection<int, Appointment>
     */
    #[ORM\OneToMany(targetEntity: Appointment::class, mappedBy: 'patient')]
    private Collection $appointments;

    public function __construct()
    {
        $this->bills = new ArrayCollection();
        $this->medicalHistories = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurnames(): ?string
    {
        return $this->surnames;
    }

    public function setSurnames(string $surnames): static
    {
        $this->surnames = $surnames;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        if (!in_array($gender, array(self::FEMALE_GENDER, self::MALE_GENDER, self::OTHER))) {
            throw new \InvalidArgumentException('El género no es válido');
        }
        $this->gender = $gender;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, Bills>
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    public function addBill(Bills $bill): static
    {
        if (!$this->bills->contains($bill)) {
            $this->bills->add($bill);
            $bill->setPatient($this);
        }

        return $this;
    }

    public function removeBill(Bills $bill): static
    {
        if ($this->bills->removeElement($bill)) {
            // set the owning side to null (unless already changed)
            if ($bill->getPatient() === $this) {
                $bill->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MedicalHistory>
     */
    public function getMedicalHistories(): Collection
    {
        return $this->medicalHistories;
    }

    public function addMedicalHistory(MedicalHistory $medicalHistory): static
    {
        if (!$this->medicalHistories->contains($medicalHistory)) {
            $this->medicalHistories->add($medicalHistory);
            $medicalHistory->setPatient($this);
        }

        return $this;
    }

    public function removeMedicalHistory(MedicalHistory $medicalHistory): static
    {
        if ($this->medicalHistories->removeElement($medicalHistory)) {
            // set the owning side to null (unless already changed)
            if ($medicalHistory->getPatient() === $this) {
                $medicalHistory->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): static
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->setPatient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): static
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getPatient() === $this) {
                $appointment->setPatient(null);
            }
        }

        return $this;
    }
}
