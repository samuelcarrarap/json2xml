# json2xml
PHP class that converts json to XML.

**USAGE**
````php
require_once('Json2XML.class.php');

$json = '{ "books": [{ "title": "The Chronicles of Narnia" }] }';

$json2xml = new Json2XML();

$xml = $json2xml->convert($json, 'main');
````

**RESULT**
````xml
<main>
	<books>
		<title>The Chronicles of Narnia</title>
	</books>
</main>
```` 
