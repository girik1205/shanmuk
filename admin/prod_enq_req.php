<?php 
$prodUrl=str_replace('admin/','',$webUrl);
if($actionDelete){
	$db= new Connection();
	$db->table="product_enq";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionList){

	$db= new Connection();
	$db->from="product_enq";
	$db->select="product_enq.*,products.id as pid,products.name as pname,products.seo_name as pseo_name,products.cat_type as pcat_type,categories.id as cid,categories.seo_name as cseo_name,categories.name as cname";
	$db->where=array("product_enq.status"=>1);
	$db->limit=1000;
	$db->type="contacts";
	$db->qurry_etra=" order by id desc ";
	$db->join=" join products on product_enq.product_id=products.id
	join categories on categories.id=products.cat_type  ";
	$result=$db->get_all_records()['items'];
	$db->connectionClose();
?>
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
	        <th class="col-md-3">Category - Product Name</th>
	        <th class="col-md-2">Email</th>
	        <th class="col-md-2">Mobile</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php

			$sno=1;
			foreach ($result as $index => $row) {
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
						<td><a href="'.$prodUrl.'products/'.$row['cseo_name'].'/'.$row['pseo_name'].'" target="_blank">'.$row['cname'].'-'.$row['name'].'</a></td>
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
