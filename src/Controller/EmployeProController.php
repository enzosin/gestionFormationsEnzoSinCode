<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeProController extends AbstractController
{
    /**
     * @Route("/employe/pro", name="employe_pro")
     */
    public function index(): Response
    {
        return $this->render('employe_pro/index.html.twig', [
            'controller_name' => 'EmployeProController',
        ]);
    }
}
