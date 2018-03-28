<?php 
if($_REQUEST['action']=='add_cat'){
	$db= new Connection();
	$db->table="careers";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'career_desc'=>$_REQUEST['career_desc'],
				'position'=>$_REQUEST['position'],
				'location'=>$_REQUEST['location'],
				'status'=>1
				);
	$db->insertData();
	$db->connectionClose();
	$actionList=true;
}

if($_REQUEST['action']=='edit_cat'){
	$db= new Connection();
	$db->table="careers";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'career_desc'=>$_REQUEST['career_desc'],
				'position'=>$_REQUEST['position'],
				'location'=>$_REQUEST['location'],
				'status'=>1);
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
	$actionList=true;
}

if($actionDelete){
	$db= new Connection();
	$db->table="careers";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="careers";
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
	        <th class="col-md-1">Job Name</th>
	        <th class="col-md-3">Position</th>
	        <th class="col-md-3">Location</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="careers";
			$db->select="*";
			$db->where=array("status"=>1);
			$db->limit=200;
			$db->type="slider Text";
			$result=$db->get_all_records()['items'];
			$db->connectionClose();
			$sno=1;
			foreach ($result as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['position'].'</td>
						<td>'.$row['location'].'</td>
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
		<form method="post" class="form-group padding15">

			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name"  class="form-control" required value="<?=$formData['name']?>"  pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="position">Position</label>
			<input type="text" name="position" id="position" placeholder="Seo Name"  class="form-control" required value="<?=$formData['position']?>" pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="location">Location</label>
			<input type="text" name="location" id="location" placeholder="Seo Name"  class="form-control" required value="<?=$formData['location']?>" pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="career_desc">Job Detail</label>
			<textarea name="career_desc" id="career_desc" class="form-control"><?=$formData['career_desc']?></textarea>
			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>
			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>