<?php 
if($_REQUEST['action']=='add_cat'){
	$db= new Connection();
	$db->table="slider_content";
	$db->data=	array(
				'welcome_text'=>$_REQUEST['welcome_text'],
				'main_text'=>$_REQUEST['main_text'],
				'sub_text'=>$_REQUEST['sub_text'],
				'view_more_link'=>$_REQUEST['view_more_link'],
				'status'=>1
				);
	$db->insertData();
	$db->connectionClose();
	$actionList=true;
}

if($_REQUEST['action']=='edit_cat'){
	$db= new Connection();
	$db->table="slider_content";
	$db->updateDataset=	array(
				'welcome_text'=>$_REQUEST['welcome_text'],
				'main_text'=>$_REQUEST['main_text'],
				'sub_text'=>$_REQUEST['sub_text'],
				'view_more_link'=>$_REQUEST['view_more_link']
				);
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
	$actionList=true;
}

if($actionDelete){
	$db= new Connection();
	$db->table="slider_content";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="slider_content";
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
	        <th class="col-md-1">Welcome Text</th>
	        <th class="col-md-3">Main Text</th>
	        <th class="col-md-3">Sub Text</th>
	        <th class="col-md-3">Link</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="slider_content";
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
						<td>'.$row['welcome_text'].'</td>
						<td>'.$row['main_text'].'</td>
						<td>'.$row['sub_text'].'</td>
						<td>'.$row['view_more_link'].'</td>
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
			<input type="text" name="welcome_text" id="welcome_text" placeholder="Welcome Text"  class="form-control" required value="<?=$formData['welcome_text']?>">
			<input type="text" name="main_text" id="main_text" placeholder="Main Text"  class="form-control" required value="<?=$formData['main_text']?>">
			<input type="text" name="sub_text" id="sub_text" placeholder="Sub Text"  class="form-control" required value="<?=$formData['sub_text']?>">
			<input type="text" name="view_more_link" id="view_more_link" placeholder="Vire More Link"  class="form-control" required value="<?=$formData['view_more_link']?>">
			<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_cat':'add_cat'?>">
			<?php if($actionEdit)
				echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>
			<input type="submit" name="sumbit" class="pull-right btn btn-primary">
		</form>
	</div>
<?php } ?>