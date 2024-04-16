<?php

namespace App\Controller;

use App\Entity\Oeuvreart;
use App\Entity\Panier;
use App\Form\PanierType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{


    #[Route('/add/{id}', name: 'app_add_panier', methods: ['GET'])]
    public function addPanier(Oeuvreart $produit,$id,SessionInterface $session,EntityManagerInterface $entityManager)
    {
        $panier = $session->get("panier",[]);
        $id=$produit->getIdoeuvre();
        if (!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
        $session->set("panier",$panier);
        return $this->redirectToRoute("client");

    }


    #[Route('/addpanier/{id}', name: 'addPanierPanier', methods: ['GET'])]
    public function addPanierPanier(Oeuvreart $produit,$id,SessionInterface $session,EntityManagerInterface $entityManager)
    {
        $panier = $session->get("panier",[]);
        $id=$produit->getIdoeuvre();
        if (!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
        $session->set("panier",$panier);
        return $this->redirectToRoute("app_panier_index");

    }




    #[Route('/', name: 'app_panier_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $panier = $session->get("panier", []);

        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $product =  $entityManager
                ->getRepository(Oeuvreart::class)
                ->find($id);
            $dataPanier[] = [
                "produit" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getPrix() * $quantite;
        }

        return $this->render("panier/index.html.twig",compact("dataPanier","total"));

    }


    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Oeuvreart $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getIdoeuvre();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_panier_index");
    }


    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Oeuvreart $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getIdoeuvre();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_panier_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("app_panier_index");
    }


}
