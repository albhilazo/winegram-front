<?php

namespace AppBundle\Services;

use Elasticsearch\Client;


class GetSummaryProductSentiment
{

    const INDEX_NAME = 'winegram';
    const TYPE_NAME  = 'comment';

    private $elasticClient;
    private $retrieveProduct;




    public function __construct(Client $elasticClient)
    {
        $this->elasticClient = $elasticClient;
    }




    public function getHash($productId)
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
                                    [ 'term' => ['search_type' => 'uvinum'] ],
                                    [ 'term' => ['search_content' => $productId] ]
                                ]
                            ]
                        ]
                    ]
                ],
                'aggs' => [  
                    'top-terms-aggregation' => [
                        'terms' => [
                            'field' => 'text_sentiment'
                        ]
                    ]
                ]
            ]
        ];

        $result = $this->elasticClient->search($params);

        return $result['aggregations']['top-terms-aggregation']['buckets'];
    }

}
