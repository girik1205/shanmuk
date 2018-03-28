<?php 
if($_REQUEST['action']=='add_cat'){
	/*foreach($_FILES as $key=>$v){
		$ext = pathinfo($v['name'], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($v['tmp_name'],$sourceDir.$filename)){
		$image_url=$sourceDir.$filename;
		}
	}*/

	$db= new Connection();
	$db->table="galleries";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'status'=>$_REQUEST['status']
				);
	$db-_FILESinsertData();
	$db->connectionClose();
	$actionList=true;
}


if($_REQUEST['action']=='edit_img_prod'){

	$db= new Connection();
	$db->from="galleries";
	$db->select=" * ";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$formData=$db->get_single_record();
	$db->connectionClose();
	$i=0;

	for($i=0;$i<count($_FILES['files']['name']);$i++){

		if($_FILES['files']['name'][$i]!=''){
		$ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$sourceDir.$filename)){
			include_once('imageResizer.php');				
			$image = new ImageResize($sourceDir.$filename);
			$image->resizeToWidth(200);
			$image->save($resizeDir.'200/'.$filename);
			
			$image->resizeToWidth(400);
			$image->save($resizeDir.'400/'.$filename);

			$image->resizeToWidth(600);
			$image->save($resizeDir.'600/'.$filename);

			$image->resizeToWidth(800);
			$image->save($resizeDir.'800/'.$filename);
		}
			$db= new Connection();
			$db->table="galleries_uploads";
			$db->data=	array(
			'gid'=>$formData['id'],
			'imageurl'=>$filename,
			'status'=>1
			);
		$db->insertData();
		$imageInsertId=$db->insert_id;
		$db->connectionClose();
		if($i==0 && $formData['coverpic']==''){
			$db= new Connection();
			$db->table="galleries";
			$db->updateDataset=	array(
				'coverpic'=>$filename,
				'thumbnil_id'=>$imageInsertId
				);						
			$db->where=array("id"=>dataDecode($_REQUEST['id']));
			$db->update_table();
			$db->connectionClose();
		}
	}
	}
}


if($_REQUEST['action']=='edit_cat'){

	$image_url='';
	/*foreach($_FILES['files'] as $key=>$_FILES){
		$ext = pathinfo($v['name'], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($v['tmp_name'],$sourceDir.$filename)){
		$image_url=$sourceDir.$filename;
		}
	}*/

	$db= new Connection();
	$db->table="galleries";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'status'=>$_REQUEST['status']
				);
/*	if($image_url!='')
		$db->updateDataset['coverpic']=$image_url;*/
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
	$actionList=true;
}

if($actionDelete){
	$db= new Connection();
	$db->table="galleries";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="galleries";
	$db->select=" * ";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$formData=$db->get_single_record();
	$db->connectionClose();
}	if($_REQUEST['action']=='add_images'){ ?>
	<div class="col-md-offset-2 col-md-8 thumbnail" >
			<form method="post" class="form-group padding15" enctype="multipart/form-data">
				<h4>Please select one or more files to upload</h4>
				<div class="col-md-8">
					<input type="file" name="files[]" id="js-upload-files" multiple accept="image/x-png,,image/jpeg" required="">
				</div>
				<input type="hidden" name="action"  id="action" value="edit_img_prod">
				<input type="hidden" name="id"  id="id" value="<?=$_REQUEST['id']?>">
				<input type="submit" name="sumbit" class="pull-right btn btn-primary">
			</form>
			<br><hr>
			<div class="">
			<?php
				$db= new Connection();
				
				$db->from="galleries";
				$db->select=" * ";
				$db->where=array("id"=>dataDecode($_REQUEST['id']));
				$formData=$db->get_single_record();
				$db->connectionClose();

			$db= new Connection();
			$db->from="galleries_uploads";
			$db->select="*";
			$db->where=array("status"=>1,"gid"=>dataDecode($_REQUEST['id']));
			$db->limit=200;
			$db->type="image data";
			$sno=1;
			$images=$db->get_all_records()['items'];
			$db->connectionClose();
			foreach($images as $key => $value){ ?>
				<div class="col-xs-3">
					<div class="thumbnail">
						<div class="text-center center-align align-center">
							<img src="./uploads/200/<?=$value['imageurl']?>" alt="image" class="img-responsive"/>
						</div>
							<?php if($formData['coverpic']==$value['imageurl']){ echo '<input type="checkbox" checked="true"> <label class="thumbnailText currentThumbnail" > Present Thumbnail </label>';  } else { ?>
						<a href="javascript:void(0)" onclick="deleteImage('<?=dataEncode($value['id'])?>')"><span class="fa fa-trash-o pull-right" style="padding-top:5px;"></a>
						<input type="checkbox" id="<?=$value['id'].'-'.$value['gid']?>"  name="makethumbnail" value="<?=dataEncode($value['id']).'#'.dataEncode($value['gid'])?>" class="makethumbnail"> <label class="thumbnailText" for="<?=$value['id'].'-'.$value['gid']?>"> Make This As Thumbnail </label>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			</div>
			<br><br>
		</div>
<?php } else 
if($actionList){ ?>
<a href="<?=$location.'&action=add'?>" class="btn btn-primary pull-right">Add New</a>
<style>
	.dataTables_filter{
		max-width: 300px;
	    float: right;
	    margin-top: 10px;
	}
</style>
<table width="100%" class="table table-striped table-bordered table-hover dataTable">
	<thead>
	    <tr>
	        <th class="col-md-1">S.No</th>
	        <th class="col-md-3">Name</th>
	        <th class="col-md-3">Add Images</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="galleries";
			$db->select="id,name";
			$db->where=array("status"=>1);
			$db->limit=500;
			$db->type="categories data";
			$result=$db->get_all_records();
			$sno=1;
			$categories=$db->get_all_records()['items'];
			$db->connectionClose();
			foreach ($categories as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
						<td><a href="'.$location.'&action=add_images&id='.(dataEncode($row['id'])).'">Add Images</a></td>
						<td> 
							<a href="'.$location.'&action=edit&id='.(dataEncode($row['id'])).'">Edit</a> | 
							<a href="'.$location.'&action=delete&id='.(dataEncode($row['id'])).'" onclick="return confirm(\'Are you sure, to Delete ?\')">Delete</a></td>
						</tr>';
			}
		?>
	</tbody>
</table>
<?php } else if($actionAdd || $actionEdit){ ?>
	<div class="col-md-offset-2 col-md-8 thumbnail">
		<form method="post" class="form-group padding15"  enctype="multipart/form-data">
			<label for="name">Gallery Name</label>
			<input type="text" name="name" id="name" placeholder="Category Name"  class="form-control" required value="<?=$formData['name']?>"  pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="status">Status</label>
			<select name="status" id="status" class="form-control" required>
				<option value="1" <?=$formData['status']=='1'?'selected':''?>>Active</option>	
				<option value="0" <?=$formData['status']=='0'?'selected':''?>>Inacive</option>
			</select>
			<div class="clearfix"></div>
			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>	

			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>


<script>
function deleteImage($imageId){
	$.ajax({
			type: "POST",
			url: '<?=$location?>',
			data: {"imageId":$imageId,"action":"deleteGalleryThumbnail"},
			success: function( result, textStatus){
				if(result=='success'){
					location.reload();
				}
			}
		});
}
$('.makethumbnail').change(function() {
    if($(this).is(":checked")) {
    	var postData = $(this).val().split('#');
	   	$.ajax({
			type: "POST",
			url: '<?=$location?>',
			data: {"productId":postData[1],"imageId":postData[0],"action":"makeMeGalThumbnail"},
			success: function( result, textStatus){
				if(result=='success'){
					location.reload();
				}
			}
		});
    }
});
</script>