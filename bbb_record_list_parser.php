<?php 
/**
 * This Code Get FilePath from command line input and count published presentation in BBB record list file
 * Also create a out file that kept unpublished records (internal id)
 * Written By : MH Malekian (mmalekian.ir)
 * PHP 8
 */
$val = getopt('f:');
if ($val === false) {
	echo "could not get value of command line\n";
    die();
}

$file=$val['f'];

$myfile = fopen($file, "r") or die("Unable to open file!");
$myoutfile = fopen($file.".out","w") or die("Unable to open output file");
$presCounter=0;
$allCounter=0;
while(!feof($myfile)) {
    $str=fgets($myfile);
    if(str_contains($str,' presentation '))
    {       
        $presCounter++;
    }else
    {
        $strArr = explode(" ",$str);
        fwrite($myoutfile,$strArr[0]."\n");
    }
    $allCounter++;
}
fclose($myfile);
fclose($myoutfile);
echo " All Records Count |  Published Records Count \n";
echo " ".$allCounter."\t\t |  ".$presCounter;
echo "\n Output Unpublished Internal_Id's In File: ".$file.".out \n";
?>