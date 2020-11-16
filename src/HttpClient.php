<?php


namespace Wikidata;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use MCC\Component\Proxy\Proxy;

class HttpClient extends Client
{
    public function __construct(?Proxy $proxy)
    {
        $clientConfig = [];
        if ($proxy instanceof Proxy && !empty($proxy->getHost())) {
            $proxyRequestOption = "{$proxy->getHost()}:{$proxy->getPort()}";
            if ($proxy->getUsername()) {
                $proxyRequestOption = "{$proxy->getUsername()}:{$proxy->getPassword()}@{$proxyRequestOption}";
            }
            $clientConfig[RequestOptions::PROXY] = "tcp://{$proxyRequestOption}";
        }
        parent::__construct($clientConfig);
    }
}
