<?php 
$_REQUEST['id']=dataEncode('1');
$actionList=false;
$actionEdit=true;
if($_REQUEST['action']=='add_cat'){
	$db= new Connection();
	$db->table="pages";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'content'=>$_REQUEST['content'],
				'status'=>1	);
	$db->insertData();
	$db->connectionClose();
	$actionEdit=true;
}

if($_REQUEST['action']=='edit_cat'){
	$db= new Connection();
	$db->table="pages";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'content'=>$_REQUEST['content'],
				'status'=>1
				);
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
	$actionEdit=true;
}


if($actionDelete){
	$db= new Connection();
	$db->table="pages";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionEdit=true;	
}


if($actionEdit){
	$db= new Connection();
	$db->from="pages";
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
	        <th class="col-md-1">Page</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="pages";
			$db->select="*";
			$db->where=array("status"=>1);
			$db->limit=1000;
			$db->type="contacts";
			$db->qurry_etra=" order by id desc ";
			$result=$db->get_all_records()['items'];
			$db->connectionClose();
			$sno=1;
			foreach ($result as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
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
			<label for="name">Page Name</label>
			<input type="text" name="name" id="name" placeholder="Category Name"  class="form-control" required value="<?=$formData['name']?>"  pattern="[A-Za-z0-9.\-\s]{2,40}">
			<label for="content">Content</label>
			<textarea name="content" id="content"  placeholder="content" class="form-control"><?=$formData['content']?></textarea>

			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>	

			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>
