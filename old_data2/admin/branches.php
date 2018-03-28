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

	if($_REQUEST['mainbranch']==1){
		$update= new Connection();
		$update->table="branches";
		$update->updateDataset=	array('mainbranch'=>0	);
		$update->where=array("mainbranch"=>1);
		$update->update_table();
		$update->connectionClose();		
	}	

	$db= new Connection();
	$db->table="branches";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'address'=>$_REQUEST['address'],
				'phone'=>$_REQUEST['phone'],
				'email'=>$_REQUEST['email'],
				'branchorder'=>$_REQUEST['branchorder'],
				'status'=>$_REQUEST['mainbranch']==1?0:$_REQUEST['status'],
				'embaindmap'=>$_REQUEST['embaindmap'],
				'mainbranch'=>$_REQUEST['mainbranch'],
				'image_url'=>$image_url
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

	if($_REQUEST['mainbranch']==1){
		$update= new Connection();
		$update->table="branches";
		$update->updateDataset=	array('mainbranch'=>0	);
		$update->where=array("mainbranch"=>1);
		$update->update_table();
		$update->connectionClose();		
	}	

	$db= new Connection();
	$db->table="branches";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'address'=>$_REQUEST['address'],
				'phone'=>$_REQUEST['phone'],
				'email'=>$_REQUEST['email'],
				'branchorder'=>$_REQUEST['branchorder'],
				'status'=>$_REQUEST['mainbranch']==1?0:$_REQUEST['status'],
				'embaindmap'=>$_REQUEST['embaindmap'],
				'mainbranch'=>$_REQUEST['mainbranch']
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
	$db->table="branches";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="branches";
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
	        <th class="col-md-2">Branch Name</th>
	        <th class="col-md-4">Address</th>
	        <th class="col-md-2">Phone</th>
	        <th class="col-md-2">Email</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="branches";
			$db->select="*";
//			$db->where=array("status"=>1);
			$db->limit=200;
			$db->qurry_etra=" order by branchorder desc ";
			$db->type="Branchs data";
			$result=$db->get_all_records()['items'];
			$sno=1;
			$db->connectionClose();
			foreach ($result as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['address'].'</td>
						<td>'.$row['phone'].'</td>
						<td>'.$row['email'].'</td>
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
			<label for="name">Branch Name</label>
			<input type="text" name="name" id="name" placeholder="Branch Name"  class="form-control" required value="<?=$formData['name']?>" pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="address">Branch Address</label>
			<textarea name="address" id="address" placeholder="Address"  class="form-control" required><?=$formData['address']?></textarea>
			<label for="phone">Phone</label>
			<input type="text" name="phone" id="phone" placeholder="Phone"  class="form-control" required value="<?=$formData['phone']?>" pattern="[0-9]{2,11}" max-length="10">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" placeholder="Email"  class="form-control" required value="<?=$formData['email']?>">
			<label for="email">Branch Order</label>
			<input type="text" name="branchorder" id="branchorder" placeholder="Branch Order"  class="form-control" required value="<?=$formData['branchorder']?>">
			<label for="status">Status</label>
			<select name="status" id="status" class="form-control" required>
				<option value=""> Select Active State</option>
				<option value="1" <?=$formData['status']=='1'?'selected':''?>>Active</option>	
				<option value="0" <?=$formData['status']=='0'?'selected':''?>>Inacive</option>
			</select>
			<div >
			<label for="embaindmap">Embed Map </label>
			<input type="text" name="embaindmap" id="embaindmap" placeholder="Embed Map" value="<?=$formData['embaindmap']?>" class="form-control"  >
			</div>
			<div >
			<label for="mainbranch"> Main Branch </label>
			<input type="checkbox" name="mainbranch" id="mainbranch" <?=$formData['mainbranch']==1?'checked':''?> value="1">
			</div>
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<div class="col-md-10">
				<input type="file" name="file" id="file">
				(recomanded size: 200 x 200)
			</div>
			<div class="col-md-2">
				<?php if($actionEdit && $formData['image_url']!='')
				echo "<img src='./".$formData['image_url']."' class='img-responsive' />"; ?>
			</div>

			<div class="clearfix"></div>
			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>	

			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>

<script type="">
	$('mainbranch').checked(function() {
		alert('sairam');
	});
</script>