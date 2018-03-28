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
include_once('header.php');
include_once($_REQUEST['page'].'.php');
include_once('footer.php');
?>
