<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProduitType;
use App\Entity\Produit;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/ajoutProduit", name="app_produit_ajouter")
     */
    public function ajoutProduit(Request $request, $produit= null)
    {
    
    if($produit == null){
        $produit = new Produit();
    }
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute('app_affP');
    }
        return $this->render('produit/editer.html.twig', array('form'=>$form->createView()));

}
/** 
     * @Route("/afficheProduit", name="app_affP")
     */
    public function afficheProduit()
    {
        $produits =  $this->getDoctrine()->getRepository(Produit::class)->findAll();
        if (!$produits) {
            $message = "Pas de Produits";
        }
        else{
            $message = null;

        }
       
        return $this->render('produit/listeproduits.html.twig', array('ensProduit' => $produits, 'message'=>$message));
    }



}
