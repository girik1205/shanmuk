<?php 
if($_REQUEST['action']=='adminLogin'){

	$db= new Connection();
	$db->from="users";
	$db->select="*";
	$db->where=array("status"=>1,"email"=>$_REQUEST['email'],"password"=>md5($_REQUEST['password']));
	$db->type="userData";
	$users=$db->get_single_record();
	$db->connectionClose();
	if($users['name']!='' && $users['email'] !=''){
		$_SESSION['userLogin']=1;
		$_SESSION['name']=$users['name'];
		$_SESSION['email']=$users['email'];
	}
}

if($_REQUEST['action']=='makeMeThumbnail'){

	$db= new Connection();
	$db->from="products_images";
	$db->select="*";
	$db->where=array("status"=>1,"product_id"=>dataDecode($_REQUEST['productId']),"id"=>dataDecode($_REQUEST['imageId']));
	$db->limit=200;
	$db->type="image data";
	$sno=1;
	$images=$db->get_all_records()['items'][0];
	$db->connectionClose();
	
	$db= new Connection();
	$db->table="products";
	$db->updateDataset=	array(
		'thmbnail_url'=>$images['url'],
		'thumbnil_id'=>dataDecode($_REQUEST['imageId'])
		);						
	$db->where=array("id"=>dataDecode($_REQUEST['productId']));
	$db->update_table();
	$db->connectionClose();
	echo "success";
	exit();
}

if($_REQUEST['action']=='deleteThumbnail'){

	$db= new Connection();
	$db->table="products_images";
	$db->where=array("id"=>dataDecode($_REQUEST['imageId']));
	$db->delete_table();
	$db->connectionClose();
	//$actionList=true;
	echo "success";
	exit();
}


if($_REQUEST['action']=='makeMeThumbnail_service'){

	$db= new Connection();
	$db->from="products_images";
	$db->select="*";
	$db->where=array("status"=>1,"service_id"=>dataDecode($_REQUEST['productId']),"id"=>dataDecode($_REQUEST['imageId']));
	$db->limit=200;
	$db->type="image data";
	$sno=1;
	$images=$db->get_all_records()['items'][0];
	$db->connectionClose();
	
	$db= new Connection();
	$db->table="services";
	$db->updateDataset=	array(
		'thmbnail_url'=>$images['url'],
		'thumbnil_id'=>dataDecode($_REQUEST['imageId'])
		);						
	$db->where=array("id"=>dataDecode($_REQUEST['productId']));
	$db->update_table();
	$db->connectionClose();
	echo "success";
	exit();
}

?>