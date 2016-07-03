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
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }


    /**
     * @Route("/last-instagram", name="last_instagram")
     */
    public function lastInstagramAction(Request $request)
    {
        $lastCommentsData = $this->get('last_comments')->getLast(8, 'instagram_post');

        return $this->render('blocks/social_comments.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
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
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
            'comments' => $lastCommentsData,
        ]);
    }

    /**
     * @Route("/cloud-products", name="cloud-products")
     */
    public function cloudProductsAction(Request $request)
    {
        $etiquetas = array(
            "HTML" => 10,
            "PHP" => 15,
            "ASP" => 6,
            "Promoción de webs" => 5,
            "Programación" => 8,
            "Javascript" => 12,
            "Ajax" => 5,
            ".NET" => 3,
            "FAQ" => 2,
            "SEO" => 9,
            "CSS" => 12,
            "XHTML" => 8,
            "Desarrollo Web" => 12,
            "Diseño" => 8,
            "Ganar dinero" => 6,
            "Freelance" => 2,
            "Cookies" => 3,
            "Software" => 10,
            "DHTML" => 7,
            "Cross-Browser" => 1
        );

        $etiquetas = $this->nube_etiquetas($etiquetas);

        return $this->render('blocks/cloud-names.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
            'names' => $etiquetas,
        ]);
    }

    private function nube_etiquetas($etiquetas)
    {
        $valor_max = max($etiquetas);
        $valor_min = min($etiquetas);
        $diferencia = $valor_max - $valor_min;

        ksort($etiquetas);

        foreach ($etiquetas as $nombreetiqueta => $apariciones) {
            $valor_relativo = round((($apariciones - $valor_min) / $diferencia) * 10);
            $etiquetas[$nombreetiqueta] = $valor_relativo;
        }

        return $etiquetas;
    }
}
