<?php 
if($_REQUEST['action']=='add_cat'){

	foreach($_FILES as $key=>$v){
		$ext = pathinfo($v['name'], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($v['tmp_name'],$sourceDir.$filename)){
		$image_url=$sourceDir.$filename;
		}
	}

	$db= new Connection();
	$db->table="categories";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'seo_name'=>$_REQUEST['seo_name'],
				'seo_keywords'=>$_REQUEST['seo_keywords'],
				'seo_description'=>$_REQUEST['seo_description'],
				'cat_type'=>$_REQUEST['cat_type'],
				'status'=>$_REQUEST['status'],
				'image_url'=>$image_url,
				'keep_home_page_slider'=>$_REQUEST['keep_home_page_slider'],
				'keep_home_page'=>$_REQUEST['keep_home_page']
				);
	$db->insertData();
	$db->connectionClose();
	$actionList=true;
}

if($_REQUEST['action']=='edit_cat'){

	$image_url='';
	foreach($_FILES as $key=>$v){
		$ext = pathinfo($v['name'], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($v['tmp_name'],$sourceDir.$filename)){
		$image_url=$sourceDir.$filename;
		}
	}

	$db= new Connection();
	$db->table="categories";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'seo_name'=>$_REQUEST['seo_name'],
				'seo_keywords'=>$_REQUEST['seo_keywords'],
				'seo_description'=>$_REQUEST['seo_description'],
				'cat_type'=>$_REQUEST['cat_type'],
				'keep_home_page_slider'=>$_REQUEST['keep_home_page_slider'],
				'keep_home_page'=>$_REQUEST['keep_home_page'],
				'status'=>$_REQUEST['status']
				);
	if($image_url!='')
		$db->updateDataset['image_url']=$image_url;
	
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
	$actionList=true;
}

if($actionDelete){
	$db= new Connection();
	$db->table="categories";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="categories";
	$db->select=" * ";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$formData=$db->get_single_record();
	$db->connectionClose();
}
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
	        <th class="col-md-1">Category Type</th>
	        <th class="col-md-3">Category Name</th>
	        <th class="col-md-3">Seo Name</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="categories";
			$db->select="id,name,seo_name,cat_type";
			$db->where=array("status"=>1);
			$db->limit=200;
			$db->type="categories data";
			$result=$db->get_all_records();
			$sno=1;
			$categories=$db->get_all_records()['items'];
			$db->connectionClose();
			foreach ($categories as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$maincat[$row['cat_type']].'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['seo_name'].'</td>
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
			<label for="name">Category Name</label>
			<input type="text" name="name" id="name" placeholder="Category Name"  class="form-control" required value="<?=$formData['name']?>"  pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="seo_name">Seo Name</label>
			<input type="text" name="seo_name" id="seo_name" placeholder="Seo Name"  class="form-control" required value="<?=$formData['seo_name']?>" pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="seo_keywords">Seo Keywords</label>
			<textarea name="seo_keywords" id="seo_keywords"  placeholder="Seo Keywords" class="form-control"><?=$formData['seo_keywords']?></textarea>
			<label for="seo_description">Seo Description</label>
			<textarea name="seo_description" id="seo_description"  placeholder="Seo Description" class="form-control"><?=$formData['seo_description']?></textarea>
			<label for="cat_type">Category Type</label>
			<select name="cat_type" id="cat_type"  class="form-control" required>
				<option value=""> Select One Option</option>
				<?php foreach($maincat as $key => $value){
					echo '<option value="'.$key.'" '.($formData['cat_type']==$key?'selected':'').'>'.$value.'</option>';
				} ?>
			</select>
			<label for="status">Status</label>
			<select name="status" id="status" class="form-control" required>
				<option value=""> Select Active State</option>
				<option value="1" <?=$formData['status']=='1'?'selected':''?>>Active</option>	
				<option value="0" <?=$formData['status']=='0'?'selected':''?>>Inacive</option>
			</select>


			<div class="col-md-10">
				<input type="file" name="file" id="file">
				(recomanded size: 200 x 200)
			</div>
			<div class="col-md-2">
				<?php if($actionEdit && $formData['image_url']!='')
				echo "<img src='./".$formData['image_url']."' class='img-responsive' />"; ?>
			</div>
			<div class="clearfix"></div>

			<div>
			<input type="checkbox" name="keep_home_page_slider" id="keep_home_page_slider" <?=$formData['keep_home_page_slider']=='1'?'checked':''?> value="1">
			<label for="keep_home_page_slider" >Keep this category in home page slider</label>
			</div>
			<div class="clearfix"></div>
			
			<div>
			<input type="checkbox" name="keep_home_page" id="keep_home_page" <?=$formData['keep_home_page']=='1'?'checked':''?> value="1">
			<label for="keep_home_page" >Keep this category in home page</label>
			</div>
			<div class="clearfix"></div>
			

			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>	

			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>