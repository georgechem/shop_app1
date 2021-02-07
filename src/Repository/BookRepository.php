<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Repository function which return random object from database
     * @return mixed
     */
    public function getRandomBook()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT b FROM App\Entity\Book b WHERE 1=1"
        );
        $result = $query->getResult();
        $max = count($result);
        $value = rand(0, $max);

        return $result[$value]->jsonSerialize();
    }

    public function getCategories()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT DISTINCT b.categories FROM App\Entity\Book b"
        );
        $result = $query->getResult();

        return $result;
    }

    public function getBooks($start, $max, $query)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT b FROM App\Entity\Book b WHERE b.title LIKE :query ORDER BY b.title ASC"
        )->setParameter('query', '%'.$query.'%');

        $paginator = new Paginator($query, false);
        $c = count($paginator);
        $paginator->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($max);

        return $paginator;
    }

    public function getBooksByCategory($start, $max, $query)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT b FROM App\Entity\Book b WHERE b.categories LIKE :query ORDER BY b.title ASC"
        )->setParameter('query', '%'.$query.'%');

        $paginator = new Paginator($query, false);
        $c = count($paginator);
        $paginator->getQuery()
            ->setFirstResult($start)
            ->setMaxResults($max);

        return $paginator;
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
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
