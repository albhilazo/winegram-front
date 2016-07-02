<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }


    /**
     * @Route("/last-instagram", name="last_instagram")
     */
    public function lastInstagramAction(Request $request)
    {
        $lastCommentsData = $this->get('last_comments')->getLast(8, 'instagram_post');

        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'comments' => $lastCommentsData,
        ]);
    }


    /**
     * @Route("/last-twitter", name="last_twitter")
     */
    public function lastTwitterAction(Request $request)
    {
        $lastCommentsData = $this->get('last_comments')->getLast(8, 'tweet');

        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'comments' => $lastCommentsData,
        ]);
    }
}
