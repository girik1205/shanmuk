<?php $gal_id=$_REQUEST['param1']!=''?$_REQUEST['param1']:0;
if(!$gal_id){ ?>
<div class="container main-content popup-one">
    <div class="tr-products">
        <?php
        $db= new Connection();
        $db->from="galleries";
        $db->select="*";
        $db->where=array("status"=>1);
        $db->limit=2;
        $db->type="slider Text";
        $result=$db->get_all_records()['items'];
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
        <?php } ?>
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
        $db= new Connection();
        $db->from="galleries_uploads";
        $db->select="*";
        $db->where=array("status"=>1,"gid"=>$gal_id);
        $db->limit=2;
        $db->type="slider Text";
        $result=$db->get_all_records()['items'];
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
</div>
<div class="clearfix"></div>
<br>
<script>
$(document).ready(function() {  $(".fancybox").fancybox(); });
</script>
<?php } ?>
