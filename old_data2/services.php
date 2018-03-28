<div class="main-content popup-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-9 push-md-4 push-lg-3">
                        <?php 
                        $db= new Connection();
                        $db->from="services";
                        $db->select=" services.*,categories.name  as cat_name,categories.seo_name as cat_seo_name ";
                        if(is_numeric($_REQUEST['service']) && $_REQUEST['service']!=''){
                            $db->where=array("services.status"=>1,"services.id"=>$_REQUEST['service']);
                        }else if($_REQUEST['service']!=''){
                            $db->where=array("services.status"=>1,"services.seo_name"=>$_REQUEST['service']);
                        } else if($_REQUEST['service']==''){
                            $db->where=array("services.status"=>1);
                            $db->qurry_etra=" order by id desc ";
                        }
                        $db->type="service category";
                        $db->join=" join categories on categories.id=services.cat_type ";
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
                        $db->where=array("service_id"=>$row['id'],'status'=>1);
                        $db->where=array("service_id"=>$row['id'],'status'=>1);
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
                                        <div class="product-details-info">
                                            <span class="product-title"><?=$row['name']?></span>
											<div><?=$row['ser_desc']?></div>
                                            <!-- <span class="price">
                                                 <?php
                                                    if($row['offerprice']==$row['price'])
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']=='' && $row['price']!='')
                                                        echo 'Rs.'.$row['price'].'/-';
                                                    else if($row['offerprice']!='' && $row['price']!='')
                                                        echo '<del>Rs.'.$row['offerprice'].'/-</del>Rs.'.$row['price'].'/-';
                                                    ?>
                                            </span>                    -->                    
                                            <p class="hidden"><?=$row['seo_name']?></p>     
                                            
                                           
                                            <div class="add-to-cart">
                                                <a class="btn btn-primary" href="shopping-cart.html">Contact Us</a>
                                            </div><!-- /.add-to-cart -->                
                                        </div><!-- /.services-details-info -->
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.services-details --> 

            <?php  }

            

            if($notfound){
                echo "404";
            } ?>
                </div>
                </div>
                    <div class="col-md-4 col-lg-3 pull-md-8 pull-lg-9">
                        <div class="gb-sidebar">
                            <div class="widget-area">           
                                <div class="widget widget_categories">
                                    <h3 class="widget_title">Services</h3>
                                    <ul>
            <?php
            $db= new Connection();
            $db->from="services";
            $db->select=" * ";
            $db->where=array("services.status"=>1);
            $db->limit=300;
            $db->type="services Text";
            $result=$db->get_all_records()['items'];
            $db->connectionClose();
            foreach ($result as $key => $value) {
                $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name'];
                echo '<li><a href="'.$location.'/'.$value['seo_name'].'">'.$value['name'].'</a></li>';
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