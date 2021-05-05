<?php
include_once "LeerXml.php";
$pathXML = 'ejemplo-cfdi.xml';
$leerXML = new LeerXml($pathXML, 'Comprobante');
//echo "<pre>";
//print_r($leerXML->toArray());
echo $leerXML->toJson();
//echo $leerXML->toString(); 