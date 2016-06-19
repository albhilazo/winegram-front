<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product/{productId}", name="product")
     */
    public function indexAction($productId, Request $request)
    {
        $productData = $this->get('retrieve_product')->get($productId);

        // replace this example code with whatever you need
        return $this->render('default/product.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'product' => $productData,
        ]);
    }
}
