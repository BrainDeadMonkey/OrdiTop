<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use App\Entity\Article;
use App\Form\SousRubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sousRubrique")
 */
class SousRubriqueController extends AbstractController
{
    /**
     * @Route("/", name="sous_rubrique_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sousRubriques = $this->getDoctrine()
            ->getRepository(SousRubrique::class)
            ->findAll();

        return $this->render('sous_rubrique/index.html.twig', [
            'sous_rubriques' => $sousRubriques,
        ]);
    }

    /**
     * @Route("/new", name="sous_rubrique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousRubrique = new SousRubrique();
        $form = $this->createForm(SousRubriqueType::class, $sousRubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousRubrique);
            $entityManager->flush();

            return $this->redirectToRoute('sous_rubrique_index');
        }

        return $this->render('sous_rubrique/new.html.twig', [
            'sous_rubrique' => $sousRubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSousRubrique}", name="sous_rubrique_show", methods={"GET"})
     */
    public function show(SousRubrique $sousRubrique): Response
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

        return $this->render('sous_rubrique/show.html.twig', [
            'sous_rubrique' => $sousRubrique,
            'articles'=> $articles,
        ]);
    }

    /**
     * @Route("/{idSousRubrique}/edit", name="sous_rubrique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousRubrique $sousRubrique): Response
    {
        $form = $this->createForm(SousRubriqueType::class, $sousRubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_rubrique_index');
        }

        return $this->render('sous_rubrique/edit.html.twig', [
            'sous_rubrique' => $sousRubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSousRubrique}", name="sous_rubrique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousRubrique $sousRubrique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousRubrique->getIdSousRubrique(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousRubrique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_rubrique_index');
    }
}
