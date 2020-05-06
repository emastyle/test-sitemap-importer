<?php

namespace SitemapImporter;

/**
 * Class SitemapImporter
 * @package SitemapImporter
 */
class SitemapImporter
{

    /**
     * @param $sourceUrl
     * @return array
     */
    public function ImportSitemapByUrl($sourceUrl) {
        $content = file_get_contents($sourceUrl);
        $sitemapXml = simplexml_load_string($content);

        if (empty($sitemapXml)) {
            return [];
        }

        return $this->ImportSitemap($sitemapXml);
    }

    /**
     * @param $sourceXML
     * @return array
     */
    public function ImportSitemapByXML($sourceXML) {
        return $this->ImportSitemap($sourceXML);
    }

    /**
     * @param $sitemapXml
     * @return array
     */
    protected function ImportSitemap($sitemapXml)
    {
        $mapData = [];
        foreach ($sitemapXml->sitemap as $sitemapElement) {
            $url = parse_url((string)$sitemapElement->loc);
            $mapData[$url['host']][] = ltrim($url['path'], '/');
        }
        return $mapData;
    }
}
