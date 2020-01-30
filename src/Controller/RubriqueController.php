<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use App\Entity\Article;
use App\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rub")
 */
class RubriqueController extends AbstractController
{
    /**
     * @Route("/", name="rubrique_index", methods={"GET"})
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

        return $this->render('rubrique/rubriques.html.twig', [
            'articles' => $articles,
            'rubriques' => $rubriques,
            'sousrubriques' => $sousrubriques,
        ]);
    }

    /**
     * @Route("/new", name="rubrique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rubrique = new Rubrique();
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rubrique);
            $entityManager->flush();

            return $this->redirectToRoute('rubrique_index');
        }

        return $this->render('rubrique/new.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRubrique}", name="rubrique_show", methods={"GET"})
     */
    public function show(Rubrique $rubrique): Response
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


        return $this->render('rubrique/show.html.twig', [
            'articles' => $articles,
            'sousrubriques' => $sousrubriques,
            'rubrique' => $rubrique,
        ]);
    }

    /**
     * @Route("/{idRubrique}/edit", name="rubrique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rubrique $rubrique): Response
    {
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rubrique_index');
        }

        return $this->render('rubrique/edit.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idRubrique}", name="rubrique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rubrique $rubrique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rubrique->getIdRubrique(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rubrique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rubrique_index');
    }
}
