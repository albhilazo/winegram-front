<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


final class TopSellingController extends Controller
{
    /**
     * @Route("/top-sellings", name="top-selling")
     */
    public function indexAction(Request $request)
    {
        $api_client = $this->get('uvinum_api_client');
        $response        = $api_client->getTopSellingWines('tinto');
        $json_response = $response->json();
        
        return $this->render('default/top_sellings.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'products' => $json_response['products'],
        ]);
    }
}
