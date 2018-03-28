<?php $gal_id=$_REQUEST['param1']!=''?$_REQUEST['param1']:0;
if(substr( $gal_id, 0, 1 ) === "p"){
	$_REQUEST['p_page']=substr( $gal_id,1);
	$gal_id=0;
}
if(!$gal_id){ ?>
<div class="container main-content popup-one">
    <div class="tr-products">
        <?php		
        $db= new Connection();
        $db->from="galleries";
        $db->select="*";
        $db->where=array("status"=>1);
        $db->limit=$pagg_limit;
        $db->offset=$_REQUEST['p_page']*$pagg_limit;
        $db->type="slider Text";
        $data=$db->get_all_records();
        $itemsCnt=ceil($data['totalCount']/$db->limit);
        $result=$data['items'];
        $db->connectionClose();
        $sno=1;
        foreach ($result as $key => $row) {  ?>
        <div class="col-md-3 col-lg-3 pull-left">
            <div class="product">
            <a href="<?=$location?>/<?=$row['id']?>">
                <span class="product-image">
                    <img src="<?=$webUrl?>/admin/uploads/200/<?=$row['coverpic']?>" alt="Image" class="img-fluid">
                </span>
                <span class="product-title"><?=$row['name']?></span>
            </a>
            </div><!-- /.product -->                                    
        </div>
        <?php }  ?>
    </div>

    <div class="clearfix"></div>
    <div class="pull-right" >
    <br>
        <nav aria-label="...">
          <ul class="pagination pagination-sm">
            <li class="page-item <?=$_REQUEST['p_page']==0?'disabled':'';?>">
              <a class="page-link" href="<?=$pageUrl=$location.'';?>" tabindex="-1"><<</a>
            </li>
            <?php for($page=0;$page<$itemsCnt;$page++){
				if($page==0)
                $pageUrl=$location;
				else
				$pageUrl=$location.'/p'.$page;
                ?> 
            <li class="page-item <?=$_REQUEST['p_page']==$page?'active':'';?>"><a class="page-link" href="<?=$pageUrl?>"><?=($page+1)?></a></li>
            <?php } ?>
            <li class="page-item <?=$_REQUEST['p_page']==$itemsCnt-1?'disabled':'';?>">
              <a class="page-link" href="<?=$pageUrl=$location.'/p'.($itemsCnt-1);?>">>></a>
            </li>
          </ul>
        </nav>
    <br>
    </div>
</div>
<div class="clearfix"></div>
<?php } else { ?>
<script type="text/javascript" src="<?=$webUrl?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$webUrl?>js/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="<?=$webUrl?>css/jquery.fancybox.css" type="text/css" media="screen" />
<div class="container main-content popup-one">
    <div class="">
        <style type="">
            .row_gal{
                margin-right: -5px;
                margin-left: -5px;
            }
        </style>
        <?php	
		if(substr($_REQUEST['param2'], 0, 1 ) === "p"){
		$_REQUEST['p_page']=substr($_REQUEST['param2'],1);
		}
        $db= new Connection();
        $db->from="galleries_uploads";
        $db->select="*";
        $db->where=array("status"=>1,"gid"=>$gal_id);
        $db->limit=1;
		$db->offset=$_REQUEST['p_page']* $db->limit;
        $db->type="slider Text";
        $data=$db->get_all_records();
		$itemsCnt=ceil($data['totalCount']/$db->limit);
        $result=$data['items'];
        $db->connectionClose();
        $sno=1;
        foreach ($result as $key => $row) {  ?>
            <div class="col-md-2 col-xs-4 pull-left">
                <div class="row_gal thumbnail">
                    <a href="<?=$webUrl?>/admin/uploads/600/<?=$row['imageurl']?>" class="fancybox" rel="kisanagrimall">
                        <img class="img-responsive" src="<?=$webUrl?>/admin/uploads/200/<?=$row['imageurl']?>" alt="">
                    </a>
                </div>
            </div>
        <?php } ?>
        </div>
		
	<div class="clearfix"></div>
    <div class="pull-right" >
    <br>
        <nav aria-label="...">
          <ul class="pagination pagination-sm">
            <li class="page-item <?=$_REQUEST['p_page']==0?'disabled':'';?>">
              <a class="page-link" href="<?=$pageUrl=$clocation.'/p0';?>" tabindex="-1"><<</a>
            </li>
            <?php for($page=0;$page<$itemsCnt;$page++){
                $pageUrl=$clocation.'/p'.$page;
                ?> 
            <li class="page-item <?=$_REQUEST['p_page']==$page?'active':'';?>"><a class="page-link" href="<?=$pageUrl?>"><?=($page+1)?></a></li>
            <?php } ?>
            <li class="page-item <?=$_REQUEST['p_page']==$itemsCnt-1?'disabled':'';?>">
              <a class="page-link" href="<?=$pageUrl=$clocation.'/p'.($itemsCnt-1);?>">>></a>
            </li>
          </ul>
        </nav>
    <br>
    </div>
</div>
<div class="clearfix"></div>
<br>
<script>
$(document).ready(function() {  $(".fancybox").fancybox(); });
</script>
<?php } ?>
