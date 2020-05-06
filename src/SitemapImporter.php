<?php

namespace devtest;

use vipnytt\SitemapParser;
use vipnytt\SitemapParser\Exceptions\SitemapParserException;
use vipnytt\SitemapParser\Exceptions\TransferException;

class SitemapImporter
{
    /**
     * @param string $sourceUrl
     * @return array
     * @throws SitemapParserException
     * @throws TransferException
     */
    public function getData(string $sourceUrl)
    {
        $parser = new SitemapParser();
        $parser->parse($sourceUrl);
        $result = [];
        foreach ($parser->getURLs() as $url => $tags) {
            $parsed = parse_url($url);
            $result[$parsed['host']][] = [
                'url' => substr($parsed['path'], 1)
            ];
        }
        return $result;
    }
}
