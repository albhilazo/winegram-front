<?php

namespace AppBundle\Services;

use Elasticsearch\Client;


class RetrieveProduct
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'wine';

    private $elasticClient;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }




    public function get($productId)
    {
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => self::TYPE_NAME,
            'id'    => $productId
        ];

        return $this->elasticClient->get($params)['_source'];
    }

}
