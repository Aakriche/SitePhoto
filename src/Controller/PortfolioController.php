<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategoriesRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/portfolio/{slug}", name="portfolio_categorie")
     */
    public function categorie(Categorie $categorie, PeintureRepository $peintureRepository): Response
    {
        $peintures = $peintureRepository->findAllPortfolio($categorie);

        return $this->render('portfolio/categorie.html.twig', [
            'categorie' => $categorie,
            'peintures' => $peintures,
        ]);
    }
}
