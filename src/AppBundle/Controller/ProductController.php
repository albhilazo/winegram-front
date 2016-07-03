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

        // replace this example code with whatever you need
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
        $tweetsData = $this->get('retrieve_product.tweets')->get($productId, 8);

        // replace this example code with whatever you need
        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'comments' => $tweetsData,
        ]);
    }

    /**
     * @Route("/product/{productId}/sentiment", name="product_sentiment")
     */
    public function sentimentAction($productId, Request $request)
    {
        //3 graficas, o elegir una categoria (social, emotion o language)
        $twitts = [];
        //zero
        $twitts[0]['social_tone']['Openness'] = 0.991000;
        $twitts[0]['social_tone']['Emotional Range'] = 0.027000;
        $twitts[0]['social_tone']['Extraversion'] = 0.607000;
        $twitts[0]['social_tone']['Conscientiousness'] = 0.957000;
        $twitts[0]['social_tone']['Agreeableness'] = 0.115000;
        $twitts[0]['language_tone']['Confident'] = 0.607000;
        $twitts[0]['language_tone']['Analytical'] = 0.957000;
        $twitts[0]['language_tone']['Tentative'] = 0.115000;
        $twitts[0]['emotion_tone']['Sadness'] = 0.991000;
        $twitts[0]['emotion_tone']['Anger'] = 0.027000;
        $twitts[0]['emotion_tone']['Fear'] = 0.607000;
        $twitts[0]['emotion_tone']['Disgust'] = 0.957000;
        $twitts[0]['emotion_tone']['Joy'] = 0.115000;
        //uno
        $twitts[1]['social_tone']['Openness'] = 0.991000;
        $twitts[1]['social_tone']['Emotional Range'] = 0.027000;
        $twitts[1]['social_tone']['Extraversion'] = 0.607000;
        $twitts[1]['social_tone']['Conscientiousness'] = 0.957000;
        $twitts[1]['social_tone']['Agreeableness'] = 0.115000;

        $info = [];
        $info["packets"] = [];
        $openess = [];
        $emotional = [];
        $extra = [];
        $conscien = [];
        $agree = [];

        //Por cada twitt nos guardamos en un array su valor.
        foreach ($twitts as $clave => $twitt_item){
            $openess[$clave] = $twitt_item['social_tone']['Openness'];
            $emotional[$clave] = $twitt_item['social_tone']['Emotional Range'];
            $extra[$clave] = $twitt_item['social_tone']['Extraversion'];
            $conscien[$clave] = $twitt_item['social_tone']['Conscientiousness'];
            $agree[$clave] = $twitt_item['social_tone']['Agreeableness'];
        }

        //hacemos la media
        $info["packets"][0]['label'] = 'Openness';
        $info["packets"][0]['value'] = array_sum($openess) / count($openess);
        $info["packets"][1]['label'] = 'Emotional Range';
        $info["packets"][1]['value'] = array_sum($emotional) / count($emotional);
        $info["packets"][2]['label'] = 'Extraversion';
        $info["packets"][2]['value'] = array_sum($extra) / count($extra);
        $info["packets"][3]['label'] = 'Conscientiousness';
        $info["packets"][3]['value'] = array_sum($conscien) / count($conscien);
        $info["packets"][4]['label'] = 'Agreeableness';
        $info["packets"][4]['value'] = array_sum($agree) / count($agree);

        return new JsonResponse($info);
    }
}
