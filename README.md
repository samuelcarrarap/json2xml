# json2xml
PHP class that converts json to XML.

**BASIC USAGE**
````php
require_once('Json2XML.class.php');

$json = '{ "books": [{ "title": "The Chronicles of Narnia" }] }';

$json2xml = new Json2XML();

$xml = $json2xml->convert($json, 'root');

echo $xml;
````
-------------------------------------------------------------------

**RESULT**
````xml
<root><books><title>The Chronicles of Narnia</title></books></root>
```` 

**USAGE WITHOUT ROOT EXTRACTION**
````php
$json2xml = new Json2XML(false);

$xml = $json2xml->convert($json, 'root');

echo $xml;
````

-------------------------------------------------------------------

**RESULT WITHOUT ROOT EXTRACTION**
````xml
<root><books><title>The Chronicles of Narnia</title></books></root>
```` 

**USAGE WITH ROOT EXTRACTION**
````php
$json2xml = new Json2XML(true);

$xml = $json2xml->convert($json);

echo $xml;
````

**RESULT WITH ROOT EXTRACTION**
````xml
<books><title>The Chronicles of Narnia</title></books>
```` 