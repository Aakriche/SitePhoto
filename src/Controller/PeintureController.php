<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Service\CommentaireService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class PeintureController extends AbstractController
{
    /**
     * @Route("/realisations", name="realisations")
     */
    public function realisations(PeintureRepository $peintureRepository,
    PaginatorInterface $paginator,
    Request $request
    ): Response {
        $data = $peintureRepository->findBy([], ['id' => 'DESC']);

        $peintures = $paginator->paginate($data, $request->query->getInt('page', 1), 6);
        return $this->render('peinture/realisations.html.twig', [
            'peintures' => $peintures,
        ]);
    }

    /**
     * @Route("/realisations/{slug}", name="realisations_details")
     */
    public function details(
        Peinture $peinture,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository
    ): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($peinture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, null, $peinture);

            return $this->redirectToRoute('realisations_details', ['slug' => $peinture->getSlug()]);
        }
       return $this->render('peinture/details.html.twig', [
           'peinture' => $peinture,
           'form' => $form->createView(),
           'commentaires' => $commentaires,]);
    }
}
