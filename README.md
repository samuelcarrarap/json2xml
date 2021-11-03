# json2xml
PHP class that converts json to XML.

**USAGE**
require_once('Json2XML.class.php');

$json = '{ "books": [{ "title": "The Chronicles of Narnia" }] }';

$json2xml = new Json2Xml();
$xml = $json2xml->convert($json, 'main');

**RESULT**
<main>
	<books>
		<title>The Chronicles of Narnia</title>
	</books>
</main>
