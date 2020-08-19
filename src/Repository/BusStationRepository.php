<?php

namespace App\Repository;

use App\Entity\BusStation;
use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\ORM\Query\AST\Join;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BusStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusStation[]    findAll()
 * @method BusStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BusStation::class);
    }

    /**
    * @return BusStation[] Returns an array of BusStation objects
    */
    public function all()
    {
        return $this->createQueryBuilder('b')
            ->join('App\Entity\Image', 'i', Join::WITH, 'i.busStation=b.id')
            ->orderBy('b.readed', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return BusStation[] Returns an array of BusStation objects
    */
    public function custom($id)
    {
        return $this->createQueryBuilder('b')
            ->join('App\Entity\Image', 'i', Join::WITH, 'i.busStation=b.id')
            ->andWhere('b.id = :val')
            ->setParameter('val', $id)
            ->orderBy('b.readed', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function updateReaded($id)
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "UPDATE bus_station SET readed=true WHERE id=:id";
        $statement = $connection->prepare($sql);

        $statement->execute(['id' => $id]);
    }

    /*
    public function findOneBySomeField($value): ?BusStation
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
