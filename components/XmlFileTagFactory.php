<?php

namespace app\components;

use app\models\XmlFileTag;
use DOMDocument;
use DOMXPath;

class XmlFileTagFactory
{
    private $doc;

    function __construct($xmlFilePath)
    {
        $this->doc = new DOMDocument();
        $this->doc->loadXML(file_get_contents($xmlFilePath));
    }

    private function getAttributesEntries() {
        $xpath = new DOMXpath($this->doc);
        $nodesList = $xpath->query('//*');
        $namesArray = [];

        foreach ($nodesList as $node) {
            $namesArray[] = $node->nodeName;
        }

        return array_count_values($namesArray);
    }

    public function getModels() {
        $metrics = $this->getAttributesEntries();
        $xmlFileTagModels = [];

        foreach ($metrics as $tag_name=>$entries) {
            $xmlFileTagModels[] = new XmlFileTag(compact('tag_name', 'entries'));
        }

        return $xmlFileTagModels;
    }
}