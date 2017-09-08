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
$array=drawArray(new DirectoryIterator('/home/daniel/catkin_ws/images/'));
//print_r($array);

$arrlen = count($array);
$img = end($array);
$imgdir = '../../../images/'.$img;
echo '<img src="'.$imgdir.'" style="height:100%;width: 100%";>';


?>













