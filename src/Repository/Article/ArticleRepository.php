<?php

namespace App\Repository\Article;

use App\Entity\Article;
use App\Repository\EnsureFoundTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    use EnsureFoundTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public static function createIsPublishedCriteria(): Criteria
    {
        return Criteria::create()->andWhere(
            Criteria::expr()->neq('a.publishedAt', null)
        );
    }

    /**
     * @return Article[]
     */
    public function findLatest(): iterable
    {
        $query = $this->createQueryBuilder('a')
            ->innerJoin('a.category', 'c')
            ->addSelect('c')
            ->orderBy('a.publishedAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        return $query->getResult();

    }

    public function findLatestByCategoryId(int $id)
    {
        $query = $this->createQueryBuilder('a')
            ->innerJoin('a.category', 'c')
            ->where('')
            ->addSelect('c')
            ->orderBy('a.publishedAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(int $id): Article
    {
        $query = $this->createQbWithPublishedCriteria()
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
        ;
        $article = $query->getOneOrNullResult();
        $this->ensureFound($article, 'Article');
        return $article;
    }


    private function createQbWithPublishedCriteria(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('a');
        return $qb->addCriteria(self::createIsPublishedCriteria());
    }
}
