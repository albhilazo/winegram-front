<?php

namespace AppBundle\Services;

use Elasticsearch\Client;


class GetLastComments
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'comment';

    private $elasticClient;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }




    public function getLast($size, $type)
    {
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => self::TYPE_NAME,
            'body'  => [
                'from' => 0,
                'size' => $size,
                'sort' => [
                    [
                        '_timestamp' => [
                            'order' => 'desc'
                        ]
                    ]
                ],
                'query' => [
                    'constant_score' => [
                        'filter' => [
                            'bool' => [
                                'must' => [
                                    [ 'term' => ['type' => $type] ],
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
