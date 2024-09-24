<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Partner;
use Doctrine\ORM\EntityManagerInterface;

class CompanyService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createCompany(string $name): Company
    {
        $company = new Company();
        $company->setName($name);
        
        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $company;
    }

    public function addPartnerToCompany(Company $company, string $partnerName): Partner
    {
        $partner = new Partner();
        $partner->setName($partnerName);
        $partner->setCompany($company);

        $this->entityManager->persist($partner);
        $this->entityManager->flush();

        return $partner;
    }

    public function removePartnerFromCompany(Company $company, Partner $partner): void
    {
        $company->removePartner($partner);
        $this->entityManager->remove($partner);
        $this->entityManager->flush();
    }

    public function getCompanyPartners(Company $company): array
    {
        return $company->getPartners()->toArray();
    }

    public function getAllCompanies(): array
    {
        return $this->entityManager->getRepository(Company::class)->findAll();
    }
}
