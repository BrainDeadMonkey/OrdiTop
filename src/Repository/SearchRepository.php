<?php

namespace App\Repository;

use App\Entity\Article;
use Symfony\Component\BrowserKit\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SearchRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param string|null $term
     * @return Article[]
     */
    public function searchAction(?string $term)
    {
        $qb = $this->createQueryBuilder('a');
        if ($term) {
            $qb->andWhere('a.modelArticle LIKE :term OR a.descriptionArticle LIKE :term OR f.nomFabricant LIKE :term')
               ->join('a.idFabricant', 'f')
               ->setParameter('term', '%' . $term . '%')
            ;
        }

        return $qb
            ->orderBy('a.modelArticle', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}