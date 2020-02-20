<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier_liste/", name="panier_liste")
     */
    public function liste(SessionInterface $session)
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);

        $panier = $session->get("panier", []);

        $article_panier = $repo->findByIdArticle(array_keys($panier));
        $total = 0;
        foreach($article_panier as $article) {
            $total += $article->getPrixArticle()*$panier[$article->getIdArticle()];
        }

        $all_cart = 0;
        foreach($panier as $num => $val) {
             $all_cart += $val;
        }
        $session->set("total", [$total]);
        $session->set('all_cart', [$all_cart]);
        
        
        return $this->render('panier/panier.html.twig', [
            "article_panier" => $article_panier,
            "panier" => $panier,
            "total" => $total,
            "all_cart" => $all_cart
        ]);
    }

    /**
     * @Route("/panier_add/{idArticle}", name="panier_add")
     */
    public function add(SessionInterface $session, article $article)
    {
        $panier = $session->get("panier", []);

        if (!array_key_exists($article->getIdArticle(), $panier)) {
            $panier[$article->getIdArticle()] = 1;
        }
        else {
            $panier[$article->getIdArticle()]++;
        }
        
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_liste");
    }

     /**
     * @Route("/panier_remove/{idArticle}", name="panier_remove")
     */
    public function remove(SessionInterface $session, $idArticle)
    {
        $panier = $session->get("panier", []);

        unset ($panier[$idArticle]);
        
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_liste");
    }

    /**
     * @Route("/panier_plus/{idArticle}", name="panier_plus")
     */
    public function plus(SessionInterface $session, $idArticle)
    {
        $panier = $session->get("panier", []);

        $panier[$idArticle]++;
        
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_liste");
    }

    /**
     * @Route("/panier_moins/{idArticle}", name="panier_moins")
     */
    public function moins(SessionInterface $session, $idArticle)
    {
        $panier = $session->get("panier", []);

        $panier[$idArticle]--;
        if ($panier[$idArticle]==0)
            unset ($panier[$idArticle]);
        
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_liste");
    }
}
