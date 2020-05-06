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
        return $this->ImportSitemap($content);
    }

    /**
     * @param $sourceXML
     * @return array
     */
    public function ImportSitemapByXML($sourceXML) {
        return $this->ImportSitemap($sourceXML);
    }

    /**
     * @param $sitemapXmlSource
     * @return array
     */
    protected function ImportSitemap($sitemapXmlSource)
    {
        $mapData = [];
        $sitemapXml = simplexml_load_string($sitemapXmlSource);
        if (!empty($sitemapXml)) {
            foreach ($sitemapXml->url as $sitemapElement) {
                $url = parse_url((string)$sitemapElement->loc);
                $mapData[$url['host']][] = ltrim($url['path'], '/');
            }
        }
        return $mapData;
    }
}
