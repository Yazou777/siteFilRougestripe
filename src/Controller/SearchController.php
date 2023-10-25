<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, ProduitRepository $repo): Response
    {
        $query = $request->request->get('search');
        $bd =null;
        if($query) {
            $bd = $repo->findBdByName($query);
        }

        return $this->render('search/index.html.twig', [
            'bds' => $bd
        ]);
    }
}
