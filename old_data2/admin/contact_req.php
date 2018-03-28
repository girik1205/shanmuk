<?php 
if($actionDelete){
	$db= new Connection();
	$db->table="contact_requests";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
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
	        <th class="col-md-1">Name</th>
	        <th class="col-md-3">Message</th>
	        <th class="col-md-2">Email</th>
	        <th class="col-md-2">Mobile</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="contact_requests";
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
						<td>'.$row['message'].'</td>
						<td>'.$row['email'].'</td>
						<td>'.$row['phone'].'</td>
						<td> 
							<a href="'.$location.'&action=delete&id='.(dataEncode($row['id'])).'" onclick="return confirm(\'Are you sure, to Delete ?\')">Delete</a></td>
						</tr>';
			}
		?>
	</tbody>
</table>

<?php } ?>
