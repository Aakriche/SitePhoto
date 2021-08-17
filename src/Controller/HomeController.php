<?php

namespace App\Controller;

use App\Repository\PeintureRepository;
use App\Repository\BlogpostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PeintureRepository $peintureRepository, BlogpostRepository $blogpostRepository): Response
    {
        return $this->render('home/realisations.html.twig', [
            'peintures' => $peintureRepository->lastThree(),
            'blogposts' => $blogpostRepository->lastThree(),
        ]);
    }
}
