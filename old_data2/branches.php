<?php 
if(isset($_REQUEST['branch']) && $_REQUEST['branch']!='') {
    $db= new Connection();
    $db->from="branches";
    $db->select="  * ";
    $db->where=array("id"=>$_REQUEST['branch'],'status'=>1);
    $db->type="branchDetail";
    $row=$db->get_single_record();
    $db->connectionClose();
} ?>

<div class="main-content popup-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 push-lg-0">
                        <?php 
                        if(isset($_REQUEST['branch']) && $_REQUEST['branch']!='') {   ?>
                            <div class="product-details section-bg-white">
                                <div class="row">
                                    <?php 
                                    if($row['image_url']=='' && $row['embaindmap']=='')
                                        $col=12;
                                    else if( $row['embaindmap']=='')
                                        $col=9;
                                    else
                                        $col=5;
                                    if($row['image_url']!=''){ ?>
                                    <div class="col-md-3">
                                        <img src="<?=$webUrl?>admin/<?=$row['image_url']?>" alt="Image" class="img-fluid">
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-<?=$col?>">
                                        <span class="product-title"><strong><?=$row['name']?></strong></span>
                                        <span class="price"><span class="icon icon-phone-call"></span> <?=$row['phone']?></span>
                                        <div class="clearfix"></div>
                                        <span class="price"><span class="fa fa-envelope"></span> <?=$row['email']?></span><br><br>
                                        <div><?=$row['address']?></div>
                                    </div>
                                    <?php if( $row['embaindmap']!=''){ ?>
                                    <div class="col-md-4">
                                        <iframe class="tr-breadcrumb text-center bg-image" src="<?=$row['embaindmap']?>" width="100%" height="100%;"   style="padding: 0px;max-height: 300px;"></iframe>
                                    </div>
                                    <?php }?>
                                </div><!-- /.row -->
                            </div><!-- /.products-details --> 

            <?php  }    ?>
                <div class="tr-products">
                    <div class="">
    <?php

            $db= new Connection();
            $db->from="branches";
            $db->select=" *  ";
            $db->where=array("status"=>1);
            $db->limit=300;
            $db->type="branchData";

            $result=$db->get_all_records();
            /*echo $result['qry'];
            exit();*/
            $db->connectionClose();
            if(count($result['items'])==0){
                $notfound=true;
                break;
            }

            foreach ($result['items'] as $key => $row) {      ?>
            <div class="col-md-4 col-lg-4 pull-left">
                <div class="product">
                    <a href="<?=$location.'/'.$row['id']?>">
                     <span class="row">
                        <span class="col-md-5">
                            <span class="product-image">
                                <?php if($row['image_url']!='')
                                    echo '<img src="'.$webUrl.'admin/'.$row['image_url'].'" alt="Image" class="img-fluid">';
                                ?>
                            </span>
                        </span>
                        <span class="col-md-7">
                            <span class="product-title"><strong><?=$row['name']?></strong></span>
                            <!-- <span class="price"><?=$row['address']?></span> -->
                            <span class="price"><span class="icon icon-phone-call"></span> <?=$row['phone']?></span>
                            <div class="clearfix"></div>
                            <span class="price"><span class="fa fa-envelope"></span> <?=$row['email']?></span>
                        </span>
                    </span>
                    </a>                                   
                </div>
            </div>
            <?php }  ?>       
                        </div><!-- /.row -->
                    </div><!-- /.tr-products -->
                    <?php 
                    if($notfound){
                        echo "404";
                    } ?>
                </div>                  
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>