<?php

namespace App\Service\Google;

use App\Model\AddressActivity;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class ActionService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function createAddressActivity(string $address): AddressActivity
    {
        $address = (new AddressActivity())
            ->setAddress($address)
            ->setRequestedAt(new DateTime());

        $this->entityManager->persist($address);
        $this->entityManager->flush();

        return $address;
    }

    public function findAllAddresses(): array
    {
        return $this->entityManager->getRepository(AddressActivity::class)
            ->createQueryBuilder('a')
            ->select()
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }
}
