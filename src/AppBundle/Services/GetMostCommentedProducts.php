<?php

namespace AppBundle\Services;

use Elasticsearch\Client;
use AppBundle\Services\RetrieveProduct;


class GetMostCommentedProducts
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'comment';

    private $elasticClient;
    private $retrieveProduct;




    public function __construct(Client $elasticClient, RetrieveProduct $retrieveProduct)
    {
        $this->elasticClient = $elasticClient;
        $this->retrieveProduct = $retrieveProduct;
    }




    public function getHash()
    {
        $params = [
            'index' => self::INDEX_NAME,
            'type'  => self::TYPE_NAME,
            'body'  => [
                'size' => 0,
                'query' => [
                    'constant_score' => [
                        'filter' => [
                            'bool' => [
                                'must' => [
                                    [ 'term' => ['search_type' => 'uvinum'] ]
                                ]
                            ]
                        ]
                    ]
                ],
                'aggs' => [  
                    'top-terms-aggregation' => [  
                        'terms' => [  
                            'field' => 'search_content',
                            'size' => 10
                        ]
                    ]
                ]
            ]
        ];

        $result = $this->elasticClient->search($params);
        $resultItems = $result['aggregations']['top-terms-aggregation']['buckets'];

        $mostCommented = [];
        foreach ($resultItems as $item) {
            $productName = $this->retrieveProduct->get($item['key'])['name'];
            $mostCommented[$item['key']] = [ 'name' => $productName, 'score' => $item['doc_count'] ];
        }

        return $mostCommented;
    }

}
