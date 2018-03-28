<?php 
if($_POST['action']=='prod_enq'){
    $db= new Connection();
    $db->table="product_enq";
    $db->data=  array(
        'name'=>$_REQUEST['name'],
        'email'=>$_REQUEST['email'],
        'phone'=>$_REQUEST['mobile'],
        'product_id'=>$_REQUEST['product_id'],
        'status'=>1
        );
    if($db->insertData()){
        $success=true;
    }
    $db->connectionClose();
}
?>
<div class="main-content popup-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-9 push-md-4 push-lg-3">
                        <?php 
                        if($_REQUEST['cat']!='' && $_REQUEST['product']!='' ){
                        $db= new Connection();
                        $db->from="products";
                        $db->select=" products.*,categories.name  as cat_name,categories.seo_name as cat_seo_name ";
                        if(is_numeric($_REQUEST['product'])){
                            $db->where=array("products.status"=>1,"categories.seo_name"=>$_REQUEST['cat'],"products.id"=>$_REQUEST['product']);
                        }else {
                            $db->where=array("products.status"=>1,"categories.seo_name"=>$_REQUEST['cat'],"products.seo_name"=>$_REQUEST['product']);
                        }
                        $db->type="product category";
                        $db->join=" join categories on categories.id=products.cat_type ";
                        //$db->qurry_etra=" group by products.cat_type ";
                        $row=$db->get_single_record();
                        ?>
                        <div class="details-content">
                        <?php if($row['id']==''){
                            $db->connectionClose();
                            break;
                            $notfound=true;
                            } else { 
                        $db->from="products_images";
                        $db->select="*";
                        $db->where=array("product_id"=>$row['id'],'status'=>1);
                        $db->where=array("product_id"=>$row['id'],'status'=>1);
                        $db->join='';
                        $images=$db->get_all_records();
                        $db->connectionClose();
                        /*echo "<pre>";
                        print_r($images['items']);
                        echo "</pre>";*/
                        ?>
                            <div class="product-details section-bg-white">
                                <div class="row">
                                    <?php if($images['items']>0){ ?>
                                    <div class="col-lg-6">
                                        <div id="details-slider" class="details-slider carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php $ii=0; foreach ($images['items'] as $key => $value) {
                                                    echo '<li data-target="#details-slider" data-slide-to="'.$ii.'" class="">
                                                    <img src="'.$webUrl.'admin/uploads/200/'.$value['url'].'" alt="Image" class="img-fluid">
                                                </li>';
                                                $ii++;
                                                } ?>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <?php $ii=0; foreach ($images['items'] as $key => $value) {
                                                    echo '<div class="carousel-item item '.($ii==0?'active':'').' ">
                                                    <img class="img-fluid" src="'.$webUrl.'admin/uploads/600/'.$value['url'].'" alt="Image">
                                                </div>';
                                                $ii++;
                                                } ?>
                                            </div>
                                        </div><!-- /#details-slider -->  
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-6">
                                        <?php if($success){ ?>
                <div class="alert alert-success">
                <strong>Thanks.!</strong> Our Team will contact you shortly.
                </div>
                <?php } ?>
                                        <div class="product-details-info">
                                            <span class="product-title"><?=$row['name']?></span>
                                            <div><?=$row['prod_desc']?></div>
                                            <span class="price">
                                                 <?php
                                                    if($row['offerprice']==$row['price'])
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']=='' && $row['price']!='')
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']!='' && $row['price']!='')
                                                        echo '<del>Rs.'.$row['offerprice'].'/-</del>Rs.'.$row['price'].'/-';
                                                    ?>
                                            </span>
                                            
                                            <p class="hidden"><?=$row['seo_name']?></p>
                                            
                                           
                                            <div class="add-to-cart">
                                                <a class="btn btn-primary" href="#"  data-toggle="modal" data-target="#myModal">Enquire</a>

                                                <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h4 class="modal-title">Product Enquiry</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>
                                                    <form method="post" class="tr-form contact-form">
                                                  <div class="modal-body">
                                                        <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Your Name" pattern="[A-Za-z0-9.\s]{3,40}">
                            </div>

                                                 <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Your Email" pattern="[A-Za-z0-9.,@\-\s]{3,40}">
                            </div>

                                                 <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <input type="text" name="mobile" id="mobile" class="form-control" required="required" placeholder="Your Mobile"  pattern="[0-9]{10}" maxlength="10">
                            </div>

                            <input type="hidden" class="form-control" name="action" value="prod_enq">
                            <input type="hidden" class="form-control" name="product_id" value="<?= $row['id']?>">
                                                  </div>
                                                  <div class="modal-footer">
                            <input type="submit" class="btn btn-primary text-center pull-right" value="Send message"><!-- 
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                  </div>
                                                    </form>
                                                </div>

                                              </div>
                                            </div>

                                            </div><!-- /.add-to-cart -->                
                                        </div><!-- /.products-details-info -->
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.products-details --> 

            <?php  }

            $db= new Connection();
            $db->from="products";
            $db->select=" products.*,categories.name as cat_name,categories.seo_name as cat_seo_name  ";
            $db->where=array("products.status"=>1,"categories.seo_name"=>$_REQUEST['cat']);
            $db->limit=300;
            $db->type="product category";
            $db->join=" join categories on categories.id=products.cat_type ";

            $result2=$db->get_all_records();
            /*echo $result['qry'];
            exit();*/
            $db->connectionClose();

            if(count($result2['items'])>0){ ?>
                            <div class="tr-products popup-one related-products">
                                <h1>Related <strong>Products</strong></h1>
                                <div class="row">
                        <?php
                                    foreach ($result2['items'] as $key => $row) { 
                                        $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name'];?>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="product">
                                            <a href="<?=$location.'/'.$_REQUEST['cat'].'/'.$row['seo_name']?>">
                                                <?php if($row['thmbnail_url']!=''){ ?>
                                                <span class="product-image">
                                                    <img src="<?=$webUrl?>admin/uploads/200/<?=$row['thmbnail_url']?>" alt="Image" class="img-fluid">
                                                </span>
                                                <?php } ?>
                                                <span class="product-title"><?=$row['name']?></span>
                                                <span class="price">
                                                    <?php
                                                    if($row['offerprice']==$row['price'])
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']=='' && $row['price']!='')
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']!='' && $row['price']!='')
                                                        echo '<del>Rs.'.$row['offerprice'].'/-</del>Rs.'.$row['price'].'/-';
                                                    ?>
                                                </span>
                                            </a>
                                        </div><!-- /.product -->                                    
                                    </div>
                                    <?php }  ?>       

                                </div><!-- /.row -->                                
                            </div><!-- /.tr-products -->                                     
                        </div>



                        <?php }

                         } else if($_REQUEST['cat']!=''){ ?>
                        <div class="tr-products">
                            <div class="row">
            <?php

            $db= new Connection();
            $db->from="products";
            $db->select=" products.*,categories.name as cat_name,categories.seo_name as cat_seo_name  ";
            $db->where=array("products.status"=>1,"categories.seo_name"=>$_REQUEST['cat']);
            $db->limit=300;
            $db->type="product category";
            $db->join=" join categories on categories.id=products.cat_type ";

            $result=$db->get_all_records();
            /*echo $result['qry'];
            exit();*/
            $db->connectionClose();
            if(count($result['items'])==0){
                $notfound=true;
                break;
            }

            foreach ($result['items'] as $key => $row) { 
                $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name'];
                ?>
            <div class="col-md-4 col-lg-4">
                <div class="product">
                    <a href="<?=$location.'/'.$_REQUEST['cat'].'/'.$row['seo_name']?>">
                        <?php if($row['thmbnail_url']!=''){ ?>
                        <span class="product-image">
                            <img src="<?=$webUrl?>admin/uploads/200/<?=$row['thmbnail_url']?>" alt="Image" class="img-fluid">
                        </span>
                        <?php } ?>
                        <span class="product-title"><?=$row['name']?></span>
                        <span class="price">
                            <?php
                            if($row['offerprice']==$row['price'])
                                echo 'Rs.'.$row['price'].'/-';
                            else if($row['offerprice']=='' && $row['price']!='')
                                echo 'Rs.'.$row['price'].'/-';
                            else if($row['offerprice']!='' && $row['price']!='')
                                echo '<del>Rs.'.$row['offerprice'].'/-</del>Rs.'.$row['price'].'/-';
                            ?>
                        </span>
                    </a>
                </div><!-- /.product -->                                    
            </div>
            <?php }  ?>       
                        </div><!-- /.row -->
                    </div><!-- /.tr-products -->
                    <?php }

                    if($notfound){
                        echo "404";
                    } ?>
                </div>
                    <div class="col-md-4 col-lg-3 pull-md-8 pull-lg-9">
                        <div class="gb-sidebar">
                            <div class="widget-area">           
                                <div class="widget widget_categories">
                                    <h3 class="widget_title">Products</h3>
                                    <ul>
            <?php
            $db= new Connection();
            $db->from="products";
            $db->select=" count(products.id) as cnt,products.cat_type,categories.name,categories.seo_name ";
            $db->where=array("products.status"=>1);
            $db->limit=300;
            $db->type="catgories Text";
            $db->join=" join categories on categories.id=products.cat_type ";
            $db->qurry_etra=" group by products.cat_type ";
            $result=$db->get_all_records()['items'];
            $db->connectionClose();
            foreach ($result as $key => $value) {
                $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name'];
                echo '<li><a href="'.$location.'/'.$value['seo_name'].'">'.$value['name'].'('.$value['cnt'].')</a></li>';
            }   ?>
             <!--                            <li><a href="#">All Post</a>(2)</li>
                                        <li><a href="#">Vegetables</a>(3)</li>
                                        <li><a href="#">Fruits</a>(7)</li>
                                        <li><a href="#">Dried</a>(1)</li>
                                        <li><a href="#">Vegetables</a> (9)</li>
                                        <li><a href="#">Dried Fruit </a>(10)</li> -->
                                    </ul>
                                </div><!-- /.widget -->

                            </div><!-- /.widget-area -->    
                        </div><!-- /.gb-sidebar -->                        
                    </div>                     
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>