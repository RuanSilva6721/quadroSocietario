<?php

namespace App\Service;

use App\Entity\Partner;
use Doctrine\ORM\EntityManagerInterface;

class PartnerService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPartner(string $name, $company): Partner
    {
        $partner = new Partner();
        $partner->setName($name);
        $partner->setCompany($company);
        
        $this->entityManager->persist($partner);
        $this->entityManager->flush();

        return $partner;
    }

    public function removePartner(Partner $partner): void
    {
        $this->entityManager->remove($partner);
        $this->entityManager->flush();
    }

    public function getAllPartners(): array
    {
        return $this->entityManager->getRepository(Partner::class)->findAll();
    }

    public function getPartnerById(int $id): ?Partner
    {
        return $this->entityManager->getRepository(Partner::class)->find($id);
    }
}
