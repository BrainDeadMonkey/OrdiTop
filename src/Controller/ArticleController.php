<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\SearchRepository;
use App\Entity\Rubrique;
use App\Form\ArticleType;
use App\Entity\SousRubrique;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/main")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(): Response
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

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'rubriques' => $rubriques,
            'sousrubriques' => $sousrubriques,
        ]);
    }

    /**
     * @Route("/search", name="search_result", methods={"GET"})
     */
    public function search(SearchRepository $repository, Request $request)
    {
        $a = $request->query->get('a');
        $result = $repository->searchAction($a);

        return $this->render('article/search.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mainImage = $form['kartinka']->getData();
            $originalFilename = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$mainImage->guessExtension();

            try {
                $mainImage->move(
                    $this->getParameter('new_images'),
                    $newFilename
                );
            } catch (FileException $e) {

            }

            $article->setMainImage($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idArticle}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{idArticle}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mainImage = $form['kartinka']->getData();
            if (isset($mainImage)) {
            $originalFilename = pathinfo($mainImage->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$mainImage->guessExtension();

            try {
                $mainImage->move(
                    $this->getParameter('new_images'),
                    $newFilename
                );
            } catch (FileException $e) {

            }
            $article->setMainImage($newFilename);

            }
            
            

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idArticle}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        
        if ($this->isCsrfTokenValid('delete'.$article->getIdArticle(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }


}
