<?php

namespace App\Repository;

use App\Entity\ROOM;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ROOM>
 */
class ROOMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ROOM::class);
    }
    
    
    
    public function findByDate(array $dates = []): QueryBuilder
    {
        $qb = $this->createQueryBuilder('r');

        if (\array_key_exists('start', $dates)) {
            $qb->andWhere('r.date >= :start')
            ->setParameter('start', new \DateTimeImmutable($dates['start']));
        }

        if (\array_key_exists('end', $dates)) {
            $qb->andWhere('r.date <= :end')
            ->setParameter('end', new \DateTimeImmutable($dates['end']));
        }

        return $qb;
    }

//    /**
//     * @return ROOM[] Returns an array of ROOM objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

public function findByQuery(string $query): array
{
    return $this->createQueryBuilder('r')
        ->where('r.title LIKE :query OR r.city LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult(); // Renvoie tous les résultats correspondants
}




public function findByRange(?int $capacityMin , ?int $capacityMax , ?string $city): array
{
    // Créer un QueryBuilder pour l'entité ROOM
    $qb = $this->createQueryBuilder('r');

    // Si capacityMin est défini, ajouter la condition correspondante
    if ($capacityMin !== null) {
        $qb->andWhere('r.capacity_min >= :capacityMin')
           ->setParameter('capacityMin', $capacityMin);
    }

    // Si capacityMax est défini, ajouter la condition correspondante
    if ($capacityMax !== null) {
        $qb->andWhere('r.capacity_max <= :capacityMax')
           ->setParameter('capacityMax', $capacityMax);
           
           
           if ($city !== null) {
           
            $qb ->andWhere('r.city LIKE :city')
            ->setParameter('city', '%' . $city . '%'); // Ajout des jokers % pour permettre la recherche partielle
    

           }


    }


    // Exécuter la requête et retourner un tableau de résultats
    return $qb->getQuery()->getResult();
}




public function findByErgonomic(?string $selectedErgonomic): array
{
    $qb = $this->createQueryBuilder('r');

    // Filtrer par ergonomie si un élément est sélectionné
    if ($selectedErgonomic) {
        $qb->andWhere('r.ergonomic LIKE :selectedErgonomic')
           ->setParameter('selectedErgonomic', '%'.$selectedErgonomic.'%'); // Utilise LIKE pour rechercher des valeurs
    }

    // Exécuter la requête et retourner un tableau de résultats
    return $qb->getQuery()->getResult();
}

public function findByEquipment(?string $selectedEquipment): array
{
    $qb = $this->createQueryBuilder('r');

    // Filtrer par équipement si un élément est sélectionné
    if ($selectedEquipment) {
        $qb->andWhere('r.equipment LIKE :selectedEquipment')
           ->setParameter('selectedEquipment', '%'.$selectedEquipment.'%'); // Utilise LIKE pour rechercher des valeurs
    }

    // Exécuter la requête et retourner un tableau de résultats
    return $qb->getQuery()->getResult();
}






}
