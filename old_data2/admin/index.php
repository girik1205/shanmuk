<?php 
error_reporting(E_ERROR |  E_PARSE);

$actionList=$actionAdd=$actionEdit=$actionDelete=false;
include_once('../config.php');
include_once('../metadata.php');
include_once('adminActions.php');
$sitename="Kisan Agrimall Admin";
$webUrl="http://kissanagrimall.com/admin/";

if($_REQUEST['page']=='logout'){
	session_destroy();
}

if( (!$_SESSION['userLogin'] && $_REQUEST['page']!='login' && $_REQUEST['page']!='forgotpassword') || (
	$_REQUEST['page']=='logout') ){
	//$_REQUEST['page']=$_POST['page']=$_GET['page']='404';
	include_once('login.php');
} else {
	$basepath=$webUrl."index.php?page=";
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
	$location=$basepath.$_REQUEST['page'];
	include_once('header.php');
	include_once($_REQUEST['page'].'.php');
	include_once('footer.php');
}
?>