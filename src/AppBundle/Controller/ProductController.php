<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function indexAction(Request $request)
    {
        $productData = [
          "name"            => "Terras Gauda Etiqueta Negra",
          "maker"           => "Bodegas Terras Gauda",
          "concrete_region" => "Galicia",
          "attributes" => [
            "vintage"        => [ "value" => "2014" ],
            "wine_type"      => [ "value" => "blanco" ],
            "bottle_volume"  => [ "value" => "750" ],
            "alcohol_volume" => [ "value" => "12.5" ],
            "grapes" => [
              [ "value" => "Albariño" ],
              [ "value" => "Caiño Blanco" ],
              [ "value" => "Loureiro" ],
            ],
          ],
          "rank" => "4.00",
          "image_full"           => "https://media-verticommnetwork1.netdna-ssl.com/wines/terras-gauda-etiqueta-negra-286807.jpg",
          "long_name"            => "Terras Gauda Etiqueta Negra 2014",
          "producer_description" => "NOTA DE CATA DE <strong>Terras Gauda Etiqueta Negra 2014</strong>: \n- Vista: amarillo paja, intenso, muy atractivo.\n- Nariz: nítidos aromas de clementina, melón, membrillo y piña madura apoyados en delicadas notas de crema catalana, mantequilla fundida y suaves recuerdos de pan tostado.\n- Boca: potente, elegante y madura, amplio, denso y con una buena acidez, augurio de uina gran longevidad. largo final de boca con sensaciones maduras y envolventes,  toques tostados de la madera.\n\nDENOMINACIÓN DE ORIGEN: Rías Baixas.\nVIÑEDO: Bodegas Terras Gauda\nUVAS: 70% Albariño, 20% Loureiro, 10% Caiño blanco. \n\nMARIDAJE DEL VINO: pescados y mariscos. \nTEMPERATURA DE CONSUMO: 12ºC\nGRADUACIÓN ALCOHÓLICA: 12%",
        ];

        // replace this example code with whatever you need
        return $this->render('default/product.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'product' => $productData,
        ]);
    }
}
