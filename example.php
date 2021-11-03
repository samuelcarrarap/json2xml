<?php
    header('Content-Type: application/xml; charset=utf-8');

    require_once('Json2XML.class.php');

    $json = '{ "books": [{ "title": "The Chronicles of Narnia" }] }';

    $json2xml = new Json2XML();
    $xml = $json2xml->convert($json, 'main');
    echo $xml;
?>