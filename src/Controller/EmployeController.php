<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmployeType;
use App\Entity\Employe;
use App\Controller\Formation;


class EmployeController extends AbstractController
{
    /**
     * @Route("/employe", name="employe")
     */
    public function index(): Response
    {
        return $this->render('employe/index.html.twig', [
            'controller_name' => 'EmployeController',
        ]);
    }

/**
     * @Route("/ajoutemploye", name="app_employe_ajouter")
     */
    public function ajoutFormation(Request $request, $employe= null)
    {
    
    if($employe == null){
        $employe = new Employe();
    }
    $form = $this->createForm(EmployeType::class, $employe);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $em=$this->getDoctrine()->getManager();
        $em->persist($employe);
        $em->flush();
        return $this->redirectToRoute('app_affE');
    }
        return $this->render('employe/editer.html.twig', array('form'=>$form->createView()));


}
/** 
     * @Route("/afficheEmploye", name="app_affE")
     */
    public function afficheEmploye()
    {
        $employes =  $this->getDoctrine()->getRepository(Employe::class)->findAll();
        if (!$employes) {
            $message = "Pas de formation";
        }
        else{
            $message = null;

        }
       
        return $this->render('employe/listeemploye.html.twig', array('ensEmploye' => $employes, 'message'=>$message));
    }
/** 
     * @Route("/suppEmploye/{id}", name="app_employe_sup")
     */
    public function suppFormation($id)
    {
        $employe = $this->getDoctrine()->getManager()->getRepository(Employe::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($employe);
        $manager->flush();
        
        return $this->redirectToRoute('app_affE');
    }

}
