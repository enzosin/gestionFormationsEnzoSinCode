<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type as leType;
use App\Entity\Employe;
use App\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function index(Request $request): Response
    {
        // $session = new Session();
        // $session->set('employeId', $user[0]->getId());
        // $session->set('statut', $user[0]->getStatut());
        
        $unEmploye= new Employe;
        $formulaireConnexion = $this->createFormBuilder($unEmploye)
                            ->add('login')
                            ->add('mdp')
                            ->add('submit',leType\SubmitType::class)
                            ->getForm();
        $formulaireConnexion->handleRequest($request);
        if($formulaireConnexion->isSubmitted() && $formulaireConnexion->isValid())
        {

            $trouve = $this->getDoctrine()->getRepository(Employe::class)->findUnEmp($unEmploye);
            if ($trouve)
            {
                $login = $formulaireConnexion->get('login')->getViewData();
                $user=$this->getDoctrine()->getRepository(Employe::class)->findBy(
                    [
                         'login'=>$login,
                         
                    ],
                    [],
                    1
                );             
                if($user == null) 
                {    
                    return $this->redirectToRoute('connexion');    
                } 
                else{
                    $session = new Session();
                    $session->set('employeId', $user[0]->getId());
                    $session->set('statut', $user[0]->getStatut());        
                 }
                 if ($this->getDoctrine()->getRepository(Employe::class)->findStatut($unEmploye)[0]->getStatut()==1)
                 {
                      return $this->redirectToRoute('app_affE');
                 }
                 else {
                    return $this->redirectToRoute('app_affEmploye');
                }
              }      
        }
        //'message'=>$message,
        return $this->render('connexion/pageConnexion.html.twig', [
            'formulaireEmploye' => $formulaireConnexion->createView(),
        ]);
    }

}