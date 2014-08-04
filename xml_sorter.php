<?php
    new xmlSort;

    class xmlSort
    {
     //load books from xml to array
     public function xmlSort()
     {
        global $argv;
        $fname = $argv[1];

        $doc = new DOMDocument();
        if($doc->load($fname)) {
            $items = $this->parse($doc);
        } else {
            die('error loading XML');
        }
        usort ($items, function($a, $b) {
            return strcmp($a['Name'], $b['Name']);
        });

        $this->save('sorted.xps',$items);

        return $res;
     }

     private function parse($doc)
     {
        $xpath = new DOMXpath($doc);
        $items = $xpath->query("Preset");
        $result = array();
        foreach($items as $item) {
           $result[] = $this->parseItem($item);
        }
        return $result;
     }

     private function parseItem($item)
     {
        $retval = array('Name'=>$item->getAttribute('Name'), 'GenericType'=>$item->getAttribute('GenericType'), 'fields'=>$this->parse_fields($item));
        return $retval;
     }


     private function parse_fields($node)
     {
        $res=array();
        foreach($node->childNodes as $child)
        {
           if($child->nodeType==XML_ELEMENT_NODE)
           {
              $res[$child->nodeName]=$this->get_value($child);
           }
        }

        return $res;
     }

     private function get_value($node)
     {
        if($node->nodeName=='PresetHeader')
        {
           $res=array();
           foreach($node->childNodes as $child)
           {
              if($child->nodeType==XML_ELEMENT_NODE)
              {
                 $res[]=$child->nodeValue;
              }
           }
           return $res;
        }
        else
        {
           return $node->nodeValue;
        }
     }

     //save array to xml
     public function save($fname, $rows)
     {
        $doc = new DOMDocument( );
        $doc->formatOutput = true;

        $items = $doc->appendChild($doc->createElement('PresetXMLTree'));
        $items->setAttribute('version',"2");

        foreach($rows as $row) {
           $item = $items->appendChild($doc->createElement('Preset'));
           $item->setAttribute('Name',$row['Name']);
           $item->setAttribute('GenericType',$row['GenericType']);
           foreach($row['fields'] as $field_name=>$field_value) {
              $f = $item->appendChild($doc->createElement($field_name));
              if($field_name=='PresetHeader') {
                 for($i=1; $i<4; $i++) {
                    if($i === 1) {
                        $patch = $f->appendChild($doc->createElement('PluginName'));
                        $patch->appendChild($doc->createTextNode(""));
                    } elseif($i === 2) {
                        $patch = $f->appendChild($doc->createElement('PluginVersion'));
                        $patch->appendChild($doc->createTextNode(""));
                    } elseif($i === 3) {
                        $patch = $f->appendChild($doc->createElement('ReadOnly'));
                        $patch->appendChild($doc->createTextNode("false"));
                    }
                 }
              } elseif($field_name=='PresetData') {
                 $f->setAttribute('Setup', 'CURRENT');
                 $Parameters = $f->appendChild($doc->createElement("Parameters"));
                 $Parameters->setAttribute("Type", "RealWorld");
                 $Parameters->appendChild($doc->createTextNode($field_value));

                 $PluginSpecific = $f->appendChild($doc->createElement('PluginSpecific'));
                 $PluginSpecific->setAttribute('TagName', 'FilenamesTag');
                 $PluginSpecific->setAttribute('MenuItemString', 'FilenamesTag');
                 $PluginSpecific->setAttribute('TagID', '1');
                 $PluginSpecific->setAttribute('DataType', 'NoData');
                 $PluginSpecific->appendChild($doc->createElement('Data'));
              } elseif($field_name=='MessageToShell') {
                 $doc->createElement($field_name);
              } else {
                 $f->appendChild($doc->createTextNode($field_value));
              }
           }
        }

        file_put_contents($fname, $doc->saveXML());
     }

    }
?>
