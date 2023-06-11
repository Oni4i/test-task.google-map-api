<?php

namespace App\Model;

use App\Repository\AddressActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressActivityRepository::class)]
#[ORM\Table(name: 'address_activity')]
class AddressActivity implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id = null;
    #[ORM\Column(type: 'string')]
    private string $address;
    #[ORM\Column(name: 'requested_at', type: 'datetime')]
    private \DateTimeInterface $requestedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getRequestedAt(): \DateTimeInterface
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeInterface $requestedAt): self
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'address' => $this->address,
            'requestedAt' => $this->requestedAt->format('Y-m-d H:i:s'),
        ];
    }
}
