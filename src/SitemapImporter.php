<?php

namespace SitemapImporter;

/**
 * Class SitemapImporter
 * @package SitemapImporter
 */
class SitemapImporter
{
    /**
     * @param $source
     * @return array
     */
    public function ImportSitemap($source)
    {
        $content = file_get_contents($source);
        $sitemapXml = simplexml_load_string($content);

        if (empty($sitemapXml)) {
            return [];
        }

        $mapData = [];
        foreach ($sitemapXml->sitemap as $sitemapElement) {
            $url = parse_url((string)$sitemapElement->loc);
            $mapData[$url['host']][] = ltrim($url['path'], '/');
        }
        return $mapData;
    }
}
