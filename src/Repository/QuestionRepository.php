<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class QuestionRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Question::class);
    }

    /**
     * @return Question[]
     */
    public function findAllAskedOrderByNewest(): array {
        //SELECT * FROM questions WHERE asked_at IS NOT NULL ORDER BY asket_at LIMIT 10
        return $this->getResultFromQueryBuilder(
            $this->addIsAskedQueryBuilder()
            ->addOrderBy('q.askedAt', 'DESC')
            ->setMaxResults(5)
        );
    }

    private function getResultFromQueryBuilder(QueryBuilder $queryBuilder): array {
        return $queryBuilder->getQuery()->getResult();
    }

    private function addIsAskedQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder {
        return $this->getOrCreateQueryBuilder()->andWhere('q.askedAt IS NOT NULL');
    }

    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null) {
        return $queryBuilder ?? $this->createQueryBuilder('q');
    }
}
