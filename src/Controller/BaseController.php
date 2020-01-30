<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use App\Repository\SearchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController {

    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $rubriques = $this->getDoctrine()
            ->getRepository(Rubrique::class)
            ->findAll();

        $sousrubriques = $this->getDoctrine()
            ->getRepository(SousRubrique::class)
            ->findAll();

        return $this->render('/rubrique/rubriques.html.twig', [
            'articles' => $articles,
            'rubriques' => $rubriques,
            'sousrubriques' => $sousrubriques,
        ]);
    }

}