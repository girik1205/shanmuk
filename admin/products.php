<style>
.tabs-left, .tabs-right {
  margin-top: -2px;
  border-bottom: none;
  padding-top: 2px;
}/*
.tabs-left {
  border-right: 1px solid #ddd;
}*/
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
  background: #ececec;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
    background: silver;
    color: black;
    font-size: 16px;
    font-weight: 600;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.thumbnailText{
	font-size: 11px !important;
	font-weight: 500 !important;
}
.currentThumbnail{
	color: green;
}
</style>
<?php 
if($_REQUEST['action']=='add_prod'){
	$db= new Connection();
	$db->table="products";
	$db->data=	array(
				'name'=>$_REQUEST['name'],
				'cat_type'=>$_REQUEST['cat_type'],
				'price'=>$_REQUEST['price'],
				'offerprice'=>$_REQUEST['offerprice'],
				'stockcount'=>$_REQUEST['stockcount'],
				'prod_desc'=>$_REQUEST['prod_desc'],
				'status'=>$_REQUEST['status']
				);

	if($_REQUEST['seo_name']!='')
	$db->data['seo_name']=$_REQUEST['seo_name'];
	if($_REQUEST['seo_keywords']!='')
	$db->data['seo_keywords']=$_REQUEST['seo_keywords'];
	if($_REQUEST['seo_description']!='')
	$db->data['seo_description']=$_REQUEST['seo_description'];

	$db->insertData();
	$db->connectionClose();
//	$actionEdit=true;
}

if($_REQUEST['action']=='edit_seo_prod'){
	$db= new Connection();
	$db->table="products";
	$db->updateDataset=	array(
				'seo_name'=>$_REQUEST['seo_name'],
				'seo_keywords'=>$_REQUEST['seo_keywords'],
				'seo_description'=>$_REQUEST['seo_description']
				);
				
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
//	$actionEdit=true;
}

if($_REQUEST['action']=='edit_prod'){
	$db= new Connection();
	$db->table="products";
	$db->updateDataset=	array(
				'name'=>$_REQUEST['name'],
				'cat_type'=>$_REQUEST['cat_type'],
				'price'=>$_REQUEST['price'],
				'offerprice'=>$_REQUEST['offerprice'],
				'prod_desc'=>$_REQUEST['prod_desc'],
				'stockcount'=>$_REQUEST['stockcount'],
				'status'=>$_REQUEST['status']
				);
				
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->update_table();
	$db->connectionClose();
//	$actionEdit=true;
}

if($_REQUEST['action']=='edit_img_prod'){

	$db= new Connection();
	$db->from="products";
	$db->select=" * ";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$formData=$db->get_single_record();
	$db->connectionClose();
	$i=0;
	foreach($_FILES as $key=>$v){
		if($v['name']!=''){
		$ext = pathinfo($v['name'], PATHINFO_EXTENSION);
		$resizeDir="uploads/";
		$sourceDir="uploads/source/";
		$filename=$formData['name'].'-'.time().'.'.$ext;
		if(move_uploaded_file($v['tmp_name'],$sourceDir.$filename)){
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
		$db->table="products_images";
		$db->data=	array(
			'product_id'=>$formData['id'],
			'url'=>$filename,
			'status'=>1
			);
		$db->insertData();
		$imageInsertId=$db->insert_id;
		$db->connectionClose();
		if($i==0 && $formData['thmbnail_url']==''){
			$db= new Connection();
			$db->table="products";
			$db->updateDataset=	array(
				'thmbnail_url'=>$filename,
				'thumbnil_id'=>$imageInsertId
				);						
			$db->where=array("id"=>dataDecode($_REQUEST['id']));
			$db->update_table();
			$db->connectionClose();
		}
	}
	}

//	$actionEdit=true;
}


if($actionDelete){
	$db= new Connection();
	$db->table="products";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$db->delete_table();
	$db->connectionClose();
	$actionList=true;	
}

if($actionEdit){
	$db= new Connection();
	$db->from="products";
	$db->select=" * ";
	$db->where=array("id"=>dataDecode($_REQUEST['id']));
	$formData=$db->get_single_record();
	$db->connectionClose();
}
//if($actionAdd==true || $actionEdit==true) $actionList=false;
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
	        <th class="col-md-1">Product Name</th>
	        <th class="col-md-1">Seo Name</th>
	        <th class="col-md-3">Category Name</th>
	        <th class="col-md-3">Price</th>
	        <th class="col-md-3">Stock Availability</th>
	        <th class="col-md-1">Actions</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			$db= new Connection();
			$db->from="products";
			$db->select=" products.*,categories.name as cat_name ";
			$db->where=array("products.status"=>1);
			$db->limit=500;
			$db->type="products data";
			$db->join=" join categories on products.cat_type=categories.id";
			$sno=1;
			$products=$db->get_all_records()['items'];
			$db->connectionClose();
			foreach ($products as $index => $row) {
				if($row['stockcount']<10 && $row['stockcount']>5)
					$color="orange";
				else if($row['stockcount']<=5)
					$color="red";
				else 
					$color="blcak";
				echo 	'<tr>
						<td>'.$sno++.'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['seo_name'].'</td>
						<td>'.$row['cat_name'].'</td>
						<td>'.($row['offerprice']!=0?$row['offerprice'].'('.$row['price'].')':$row['price']).'</td>
						<td><span style="color:'.$color.'">'.$row['stockcount'].'</span></td>
						<td> 
							<a href="'.$location.'&action=edit&id='.(dataEncode($row['id'])).'">Edit</a> | 
							<a href="'.$location.'&action=delete&id='.(dataEncode($row['id'])).'" onclick="return confirm(\'Are you sure, to Delete ?\')">Delete</a></td>
						</tr>';
			}
		?>
	</tbody>
</table>
<?php } else if($actionAdd || $actionEdit){ ?>

<div class="col-md-2">
	<ul class="nav nav-tabs tabs-left sideways row">
	<li class="active"><a href="#tab1" data-toggle="tab">Information</a></li>
	<?php if($actionEdit){ ?>
	<li><a href="#tab2" data-toggle="tab">SEO</a></li>
	<li><a href="#tab3" data-toggle="tab">Images</a></li>
	<?php } ?>
	</ul>
</div>

<div class="col-md-10" style="border: 1px solid silver;min-height: 200px;">
	<div class="tab-content row">
		<div class="tab-pane active" id="tab1">
			<form method="post" class="form-group padding15">
				<label for="name">Product Name</label>
				<input type="text" name="name" id="name" placeholder="Product Name"  class="form-control" required value="<?=$formData['name']?>" pattern="[A-Za-z0-9.\-\s]{2,199}">
				<label for="prod_desc">Product Description</label>
				<textarea name="prod_desc" id="prod_desc"  class="form-control" required><?=$formData['prod_desc']?></textarea>
				<label for="cat_type">Category</label>
				<select name="cat_type" id="cat_type"  class="form-control" required>
					<option value=""> Select one Category</option>
					<?php
					$db= new Connection();
					$db->from="categories";
					$db->select="id,name,cat_type";
					$db->where=array("status"=>1,"cat_type"=>0);
					$db->limit=200;
					$db->type="categories data";
					$result=$db->get_all_records();
					$sno=1;
					$categories=$db->get_all_records()['items'];
					$db->connectionClose();

					foreach($categories as $key => $value){
						echo '<option value="'.$value['id'].'" '.($formData['cat_type']==$value['id']?'selected':'').'>'.$value['name'].'</option>';
					} ?>
				</select>
				<label for="status">Category</label>
				<select name="status" id="status" class="form-control" required>
					<option value=""> Select Active State</option>
					<option value="1" <?=$formData['status']=='1'?'selected':''?>>Active</option>	
					<option value="0" <?=$formData['status']=='0'?'selected':''?>>Inacive</option>
				</select>
				<label for="price">Price</label>
				<input type="number" name="price" id="price" placeholder="Price"   class="form-control" value="<?=$formData['price']?>"  pattern="[0-9]{0,5}" max-length="5">
				<label for="offerprice">Offer Price</label>
				<input type="number" name="offerprice" id="offerprice" placeholder="Offer Price"  class="form-control"  value="<?=$formData['offerprice']?>"   pattern="[0-9]{0,5}" max-length="5" >
				<label for="stockcount">Stock Count</label>
				<input type="number" name="stockcount" id="stockcount" placeholder="Stock Count"  class="form-control"  value="<?=$formData['stockcount']?>"    pattern="[0-9]{0,5}" max-length="5">
				<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_prod':'add_prod'?>">
				<?php if($actionEdit)
					echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>			
				<input type="submit" name="sumbit" class="pull-right btn btn-primary">
			</form>
		</div>
		<div class="tab-pane" id="tab2">
			<form method="post" class="form-group padding15">
				<label for="seo_name">Seo Name</label>
				<input type="text" name="seo_name" id="seo_name" placeholder="Seo Name"  class="form-control" required value="<?=$formData['seo_name']?>"  pattern="[A-Za-z0-9.\-,\s]{0,100}" >
				<label for="seo_keywords">Seo Keywords</label>
				<textarea name="seo_keywords" id="seo_keywords"  placeholder="Seo Keywords" class="form-control"><?=$formData['seo_keywords']?></textarea>
				<label for="seo_description">Seo Description</label>
				<textarea name="seo_description" id="seo_description"  placeholder="Seo Description" class="form-control"><?=$formData['seo_description']?></textarea>
				<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_seo_prod':''?>">
				<?php if($actionEdit)
					echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>			
				<input type="submit" name="sumbit" class="pull-right btn btn-primary">
			</form>
		</div>
		<div class="tab-pane" id="tab3">
			<form method="post" class="form-group padding15" enctype="multipart/form-data">
				<h4>Please select one or more files to upload</h4>
				<div class="col-md-8">
					<input type="file" name="files" id="js-upload-files" required="">
				</div>
				<input type="hidden" name="action"  id="action" value="<?=$actionEdit?'edit_img_prod':''?>">
				<?php if($actionEdit)
					echo '<input type="hidden" name="id"  id="id" value="'.dataEncode($formData['id']).'">' ?>	
				<input type="submit" name="sumbit" class="pull-right btn btn-primary">
			</form>
			<br><hr>
			<div class="">
			<?php
			$db= new Connection();
			$db->from="products_images";
			$db->select="*";
			$db->where=array("status"=>1,"product_id"=>$formData['id']);
			$db->limit=200;
			$db->type="image data";
			$sno=1;
			$images=$db->get_all_records()['items'];
			$db->connectionClose();
			foreach($images as $key => $value){ ?>
				<div class="col-xs-3">
					<div class="thumbnail">
						<div class="text-center center-align align-center">
							<img src="./uploads/200/<?=$value['url']?>" alt="image" class="img-responsive"/>
						</div>
							<?php if($formData['thmbnail_url']==$value['url']){ echo '<input type="checkbox" checked="true"> <label class="thumbnailText currentThumbnail" > Present Thumbnail </label>';  } else { ?>
						<a href="javascript:void(0)" onclick="deleteImage('<?=dataEncode($value['id'])?>')"><span class="fa fa-trash-o pull-right" style="padding-top:5px;"></a>
						<input type="checkbox" id="<?=$value['id'].'-'.$value['product_id']?>"  name="makethumbnail" value="<?=dataEncode($value['id']).'#'.dataEncode($value['product_id'])?>" class="makethumbnail"> <label class="thumbnailText" for="<?=$value['id'].'-'.$value['product_id']?>"> Make This As Thumbnail </label>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			</div>
			<br><br>
		</div>
	</div>
</div>

	<div class="clearfix"></div>
<?php } ?>

<script>
function deleteImage($imageId){
	$.ajax({
			type: "POST",
			url: '<?=$location?>',
			data: {"imageId":$imageId,"action":"deleteThumbnail"},
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
			data: {"productId":postData[1],"imageId":postData[0],"action":"makeMeThumbnail"},
			success: function( result, textStatus){
				if(result=='success'){
					location.reload();
				}
			}
		});
    }
});
</script>