<?php
/* 
        EJEMPLO
        include_once "clases/LeerXml.php";
		$pathXML = '/var/www/html/archivo.xml';
		$leerXML = new LeerXml($pathXML, 'Comprobante');
		echo $leerXML->toJson();
        print_r($leerXML->toArray());
        echo $leerXML->toString();
*/

class LeerXml
{
    private $DOM;
    private $item;
    public function __construct($pathXML, $tagName)
    {
        $this->DOM = new DOMDocument('1.0', 'utf-8');
        $this->DOM->loadXML(file_get_contents($pathXML), LIBXML_PARSEHUGE);
        $this->item =  $this->DOM->getElementsByTagName($tagName)->item(0);
    }

    private function getAtributos($child)
    {
        $atributes = [];
        foreach ($child->attributes as $atribute) {
            $atributes[$atribute->name] = $atribute->value;
        }
        return $atributes;
    }


    private function getNodo($item)
    {
        $nodo = [];
        if ($item->hasAttributes()) {
            $nodo =  $this->getAtributos($item);
        }

        if ($item->hasChildNodes()) {
            foreach ($item->childNodes as $key => $child) {
                if ($child instanceof DOMElement) {
                    if ($child->childElementCount > 0) {
                        $nodo[$child->localName][] =  $this->getNodo($child);
                    } else {
                        $nodo[$child->localName] = $this->getNodo($child);
                    }
                }
            }
        }

        return $nodo;
    }


    public function childsMultiple($child)
    {
        foreach ($child->childNodes as $key => $child) {
            if ($child instanceof DOMElement) {
                if ($child->childElementCount > 0) {
                    print_r($child);
                } else {
                    print_r($child);
                }
            }
        }
    }

    public function toString()
    {
        return $this->DOM->saveXML();
    }

    public function toJson()
    {
        return json_encode($this->getNodo($this->item));
    }

    public function toArray()
    {

        return $this->getNodo($this->item);
    }
}