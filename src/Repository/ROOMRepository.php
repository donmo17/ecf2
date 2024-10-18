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

    // public function findByCity(string $city): QueryBuilder
    // {
    //     $qb = $this->createQueryBuilder('room');

    //     $qb->andWhere('room.city = :city')
    //     ->setParameter('city', $city);

    //     return $qb;
    // }


    // findByCapacityMin
    // public function findByCapacityMin(int $capacityMin): array
    // {
    //     // Créer une requête avec un QueryBuilder
    //     $qb = $this->createQueryBuilder('room');
    //     $qb->andWhere('room.capacity_min <= :capacityMin')
    //         ->setParameter('capacityMin', $capacityMin);

    //     return $qb->getQuery()->getResult();
    // }

    // public function findByCapacityMax(string $capacityMax): QueryBuilder
    // {
    //     $qb = $this->createQueryBuilder('r');
    //     $qb->andWhere('r.capacity_max = :capacityMax')->setParameter('capacityMax', $capacityMax);
    //     return $qb;
    // }

    /**
     * Trouver les salles en fonction des capacités minimales et maximales.
     */
    public function findRoomsByCapacity(?string $capacityMin, ?string $capacityMax): array
    {
        $qb = $this->createQueryBuilder('room');

        // Vérifier si la capacité minimale est définie
        if ($capacityMin !== null) {
            $qb->andWhere('room.capacity_min <= :capacityMin')
            ->setParameter('capacityMin', $capacityMin);
        }

        // Vérifier si la capacité maximale est définie
        if ($capacityMax !== null) {
            $qb->andWhere('room.capacity_max >= :capacityMax')
            ->setParameter('capacityMax', $capacityMax);
        }

        return $qb->getQuery()->getResult();
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
            ->where('r.title LIKE :query OR r.city LIKE :query') // Rechercher par titre ou ville
            ->setParameter('query', '%' . $query . '%') // Ajouter des jokers pour la recherche partielle
            ->getQuery()
            ->getResult(); // Utiliser getResult pour obtenir un tableau
    }
}
