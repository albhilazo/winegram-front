<?php

namespace AppBundle\Services;

use Elasticsearch\Client;


class RetrieveProductComments
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'comment';

    private $elasticClient;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }




    public function get($productId, $type, $size)
    {

        $params = [
            'index' => self::INDEX_NAME,
            'type'  => self::TYPE_NAME,
            'body'  => [
                'from' => 0,
                'size' => $size,
                'query' => [
                    'constant_score' => [
                        'filter' => [
                            'bool' => [
                                'must' => [
                                    [ 'term' => ['type' => $type] ],
                                    [ 'term' => ['search_type' => 'uvinum'] ],
                                    [ 'term' => ['search_content' => $productId] ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $this->elasticClient->search($params)['hits']['hits'];
    }

}
