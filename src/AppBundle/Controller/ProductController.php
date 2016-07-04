<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product/{productId}", name="product")
     */
    public function indexAction($productId, Request $request)
    {
        $productData = $this->get('retrieve_product')->get($productId);

        return $this->render('default/product.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'product' => $productData,
            'product_id' => $productId,
        ]);
    }


    /**
     * @Route("/product/{productId}/tweets", name="product_tweets")
     */
    public function tweetsAction($productId, Request $request)
    {
        $tweetsData = $this->get('retrieve_product.comments')->get($productId, 'tweet', 8);

        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'comments' => $tweetsData,
        ]);
    }


    /**
     * @Route("/product/{productId}/instagrams", name="product_instagrams")
     */
    public function instagramsAction($productId, Request $request)
    {
        $instagramsData = $this->get('retrieve_product.comments')->get($productId, 'instagram_post', 8);

        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'comments' => $instagramsData,
        ]);
    }


    /**
     * @Route("/product/{productId}/sentiment", name="product_sentiment")
     */
    public function sentimentAction($productId, Request $request)
    {
        $summarySentiment = $this->get('summary_product_sentiment')->getHash($productId);

        $summarySentiment = $this->translateSentimentKeys($summarySentiment);

        return new JsonResponse($summarySentiment);
    }


    private function translateSentimentKeys($summarySentiment)
    {
        $dictionary = [
            'positive' => 'Positivo',
            'negative' => 'Negativo',
            'neutral'  => 'Neutral'
        ];

        array_walk($summarySentiment, function(&$item, $key, $dictionary)
        {
            if ($dictionary[$item['key']]) {
                $item['key'] = $dictionary[$item['key']];
            }
        }, $dictionary);

        return $summarySentiment;
    }
}
