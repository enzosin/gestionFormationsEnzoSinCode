<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inscription;
use App\Entity\Formation;
use App\Entity\Produit;
use App\Entity\Employe;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/afficherInscriptionPublic", name="afficherInscriptionPublic")
     */
    public function afficherInscriptionPublic(): Response
    {
        
        $listeInscription =  $this->getDoctrine()->getRepository(Inscription::class)->findAll();
        if (!$listeInscription) {
            $message = "Pas d'inscription";
        }
        else{
            $message = null;
        }
       
        return $this->render('Admin/listeInscriptionPublic.html.twig', array('lesInscriptions' => $listeInscription, 'message'=>$message));
    }

     /**
     * @Route("/AccepeterInscription/{id}", name="AccepeterInscription")
     */
    public function AccepeterInscription($id)
    {
        $uneInscription = $this->getDoctrine()->getRepository(Inscription::class)->find($id);

        $uneInscription->setStatut('A');
        $managerA = $this->getDoctrine()->getManager();
        $managerA->persist($uneInscription);
        $managerA->flush();
        return $this->redirectToRoute('afficherInscriptionPublic');
    }

    /**
     * @Route("/refuserInscription/{id}", name="RefuserInscription")
     */
    public function refuserinscription($id)
    {
        $uneInscription = $this->getDoctrine()->getRepository(Inscription::class)->find($id);

        $uneInscription->setStatut('R');
        $managerA = $this->getDoctrine()->getManager();
        $managerA->remove($uneInscription);
        $managerA->flush();
        return $this->redirectToRoute('afficherInscriptionPublic');
    }
}
