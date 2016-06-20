<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */
    public function indexAction(Request $request)
    {
        $queryText = $request->query->get('query');
        $searchResults = $this->get('search_product')->search($queryText);

        // replace this example code with whatever you need
        return $this->render('default/search_results.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'query_text' => $queryText,
            'results' => $searchResults,
        ]);
    }
}
