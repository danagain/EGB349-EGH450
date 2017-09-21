<?php
function drawArray(DirectoryIterator $directory)
{
    $result=array();
    foreach($directory as $object)
    {
        if($object->isDir()&&!$object->isDot())
        {
            $result[$object->getFilename()]=drawArray(new DirectoryIterator($object->getPathname()));
        }
        else if($object->isFile())
        {
            $result[]=$object->getFilename();
        }
    }
    return $result;
}
$array=drawArray(new DirectoryIterator('/usr/local/ampps/www/images/currentimg/'));
//print_r($array);

$arrlen = count($array);
//print_r($array);
$img = $array[0];
$imgdir = '../../../images/currentimg/img.jpeg';
//echo '<p>'.$imgdir.'</p>';
echo '<img src="'.$imgdir.'" style="height:100%;width: 100%";>';


?>













