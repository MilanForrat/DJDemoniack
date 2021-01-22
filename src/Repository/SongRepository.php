<?php

namespace App\Repository;

use App\Entity\Song;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Song|null find($id, $lockMode = null, $lockVersion = null)
 * @method Song|null findOneBy(array $criteria, array $orderBy = null)
 * @method Song[]    findAll()
 * @method Song[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SongRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Song::class);
    }

    public function viewById($id){
        $queryBuilder = $this->createQueryBuilder('song');
        $queryBuilder->where($queryBuilder->expr()->eq('song.id', $id));
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
    * @return Song[] Returns an array of Song objects
    */
    public function searchMix($title)
    {
        $queryBuilder = $this->createQueryBuilder('song')
        ->andWhere('song.title LIKE :title')
        ->setParameter('title', '%'.$title.'%');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
    * @return Song[] Returns an array of Song objects
    */
    public function findAllByLongDuration()
    {

        $queryBuilder = $this->createQueryBuilder('song')
        ->Where('song.duration > 30');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    /**
    * @return Song[] Returns an array of Song objects
    */
    public function findAllByShortDuration()
    {

        $queryBuilder = $this->createQueryBuilder('song')
        ->Where('song.duration < 30');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}
