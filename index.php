<?php
error_reporting(E_ERROR |  E_PARSE);
$actionList=$actionAdd=$actionEdit=$actionDelete=false;
include_once('config.php');
include_once('metadata.php');
$sitename="Kisan Agrimall";
$webUrl="http://kissanagrimall.com/";
$basepath=$webUrl."";
if($_REQUEST['action']=='add'){
	$actionAdd=true;
} else if($_REQUEST['action']=='edit'){
	$actionEdit=true;	
} else if($_REQUEST['action']=='delete'){
	$actionDelete=true;	
} else {
	$actionList=true;
}
$_REQUEST['page']=$_REQUEST['page']==''?'home':$_REQUEST['page'];
$cat='';

if($_REQUEST['cat']!='')
	$cat='/'.$_REQUEST['cat'];

$location=$basepath.$_REQUEST['page'];
$clocation=$basepath.$_REQUEST['page'];
if($_REQUEST['param1']!=''){
	$clocation=$clocation.'/'.$_REQUEST['param1'];
}
if($_REQUEST['cat']!=''){
	$clocation=$clocation.'/'.$_REQUEST['cat'];
}

//print_r($_REQUEST);
include_once('header.php');
include_once($_REQUEST['page'].'.php');
include_once('footer.php');
?>