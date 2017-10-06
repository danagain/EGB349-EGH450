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

$files = glob('/usr/local/ampps/www/images/*', GLOB_NOSORT);
foreach($files as $file){
//print_r($file);
}
//$array=drawArray(new DirectoryIterator('/usr/local/ampps/www/images/current/'));
//print_r($array);

//$arrlen = count($array);
//print_r($array);
//$img = $array[0];
$imgdir = '../../../images/currentimg/img.jpeg';
//echo '<p>'.$imgdir.'</p>';
//echo '<img id="mainimg" src="'.$imgdir.'" style="height:100%;width: 100%";>';
$img = json_encode($imgdir);
echo $img;

?>













