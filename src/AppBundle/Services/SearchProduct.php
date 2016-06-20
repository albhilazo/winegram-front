<?php

namespace AppBundle\Services;

use Elasticsearch\Client;


class SearchProduct
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'wine';

    private $elasticClient;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }




    public function search($text)
    {
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => self::TYPE_NAME,
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'type'   => 'most_fields',
                        'query'  => $text,
                        'fields' => [
                            'name', 'producer_description', 'maker_description',
                            'vintage', 'wine_type', 'grapes', 'pairing',
                            'long_name', 'maker'
                        ]
                    ]
                ]
            ]
        ];

        return $this->elasticClient->search($params)['hits']['hits'];
    }

}
