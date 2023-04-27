<?php
include('constant.php');
require '../vendor/autoload.php';
use Markdown\Converter;
use Markdown\Parser;
$id = $_GET['id'];
$md = returnTextFromWriting($conn,$id);

//$e = new Converter();
//$e->convert($body);
$converter = new Converter();
$parser = new Parser();
//file_put_contents('../output.html', $parser->text($md));
ob_start();
$converter->convert($md);
file_put_contents('../test.pdf', ob_get_clean());

?>