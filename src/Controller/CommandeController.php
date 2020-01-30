<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\Contient;
use App\Form\CommandeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(): Response
    {
        $commandes = $this->getDoctrine()
            ->getRepository(Commande::class)
            ->findAll();

        return $this->render('commande/index.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * @Route("/new", name="commande_new", methods={"GET","POST"})
     */
    public function new(SessionInterface $session, Request $request): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $entityManager = $this->getDoctrine()->getManager();

        $panier = $session->get("panier", []);
        
        $article_panier = $repo->findByIdArticle(array_keys($panier));
        $total = 0;
        foreach($article_panier as $article) {
            $total += $article->getPrixArticle()*$panier[$article->getIdArticle()];
        }

        $commande = new Commande();
        
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        $user = $this->getUser()->getClient()->getIdClient();
        foreach ($session->get('all_cart') as $all_cart) {
        }

        foreach ($session->get('total') as $total) {
        }
        if ($form->isSubmitted()) {

            $commande->setNombreArticleTotal($all_cart)
                     ->setReductionCustomer('2') 
                     ->setPrixLivraison('13.5')
                     ->setPrixTotal($total)
                     ->setModeLivraison('Domicile')
                     ->setModePaiement('VISA')
                     ->setDateCommande(new \DateTime())
                     ->setStatutCommande('En cours')
                     ->setIdAdresseFacture($this->getUser()->getClient()->getIdAdresse())
                     ->setIdAdresseLivraison($this->getUser()->getClient()->getIdAdresse())
                     ->setIdClient($this->getUser()->getClient());

            $entityManager->persist($commande);
            $entityManager->flush();

          
            foreach ($article_panier as $article) {
                
                $article1 = $repo->find($article);
                $contient = new Contient();

                $contient->setIdCommande($commande)
                         ->setNombreArticle('4')
                         ->setPrixArticle('16.6')
                         ->setPrixArticleTva('16.6')
                         ->setIdArticle($article1);

                $entityManager->persist($contient);
                $entityManager->flush();
            }

            return $this->redirectToRoute('commande_index');
        }
    

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCommande}", name="commande_show", methods={"GET"})
     */
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/{idCommande}/edit", name="commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande $commande): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCommande}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getIdCommande(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index');
    }
}
