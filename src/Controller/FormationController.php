<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;
use App\Entity\Formation;
use App\Entity\Inscription;
use App\Entity\Produit;
use App\Form\FormationType;
use App\Entity\Connexion;
use Symfony\Component\HttpFoundation\Request;


class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index(): Response
    {
            return $this->render('formation/index.html.twig', [
                'controller_name' => 'FormationController',
            ]);
    }
    
    /**
     * @Route("/ajoutformation", name="app_formation_ajouter")
     */
    public function ajoutFormation(Request $request, $formation= null)
    {
    
    if($formation == null){
        $formation = new Formation();
    }
    $form = $this->createForm(FormationType::class, $formation);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($formation);
        $em->flush();
        return $this->redirectToRoute('app_aff');
    }
        return $this->render('formation/editer.html.twig', array('form'=>$form->createView()));
    }
    

   /** 
     * @Route("/afficheFormation", name="app_aff")
     */
    public function afficheFormation()
    {
        $formations =  $this->getDoctrine()->getRepository(Formation::class)->findAll();
        if (!$formations) {
            $message = "Pas d'Employés";
        }
        else{
            $message = null;
        }
        return $this->render('formation/listeformation.html.twig', array('ensFormations' => $formations, 'message'=>$message));
    }
    /** 
     * @Route("/afficheFormationEmploye", name="app_affEmploye")
     */
    public function afficheFormationE()
    {
        
        $formationsE =  $this->getDoctrine()->getRepository(Formation::class)->findAll();
        if (!$formationsE) {
            $message = "Pas d'Employés";
        }
        else{
            $message = null;

        }
       
        return $this->render('formation/listeformationsEmploye.html.twig', array('ensFormationsEmploye' => $formationsE, 'message'=>$message));
    }

    /** 
     * @Route("/suppFormation/{id}", name="app_formation_sup")
     */
    public function suppFormation($id)
    {
        $statut=$this->get("session")->get("statut");
        $formation = $this->getDoctrine()->getManager()->getRepository(Formation::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($formation);
        $manager->flush();
        return $this->redirectToRoute('app_aff');
    }

    /** 
     * @Route("/inscrire/{id}", name="app_formation_inscrire")
     */
    public function inscrire($id)
    {
        $employeId=$this->get("session")->get("employeId");
        
        $formation = $this->getDoctrine()->getRepository(Formation::class)->find($id);
        $employe = $this->getDoctrine()->getRepository(Employe::class)->find($employeId);

        $inscription= new Inscription();
        $inscription->setStatut("E");
        $inscription->setEmploye($employe);
        $inscription->setFormation($formation);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($inscription);
        $manager->flush();

        return $this->redirectToRoute('app_affEmploye');
    }

     /** 
     * @Route("/accepterFormation", name="app_accepter_form")
     */
    public function accepterFormation()
    {
        
    }

    /** 
     * @Route("/supprimerFormation", name="app_accepter_form")
     */
    public function supprimerFormation()
    {
        
    }
 
   
}
