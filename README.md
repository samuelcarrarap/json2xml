# json2xml
PHP class that converts json to XML.

**USAGE**
````php
require_once('Json2XML.class.php');

$json = '{ "books": [{ "title": "The Chronicles of Narnia" }] }';

$json2xml = new Json2XML();
````

**USAGE WITHOUT ROOT EXTRACTION**
````php
$json2xml = new Json2XML(false);

$xml = $json2xml->convert($json, 'root');
````
**RESULT**
````xml
<root><books><title>The Chronicles of Narnia</title></books></root>
```` 
**USAGE WITH ROOT EXTRACTION**
````php
$json2xml = new Json2XML(true);

$xml = $json2xml->convert($json);
````
**RESULT WITH ROOT EXTRACTION**
````xml
<books><title>The Chronicles of Narnia</title></books>
```` 