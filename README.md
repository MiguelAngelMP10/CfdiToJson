# CfdiToJson

Es una clase que se usa para  convertir un cdfi a json.

### la forma de implementarla es la siguiente

```php
include_once "LeerXml.php";
$pathXML = 'ejemplo-cfdi.xml';
$leerXML = new LeerXml($pathXML, 'Comprobante');
//echo "<pre>";
//print_r($leerXML->toArray());
echo $leerXML->toJson();
//echo $leerXML->toString(); 
```