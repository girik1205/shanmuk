<div id="home-carousel" class="carousel slide home-slider tr-banner" data-ride="carousel" style="background-image: url(images/bg/slider1.jpg);">
    <div class="carousel-inner text-center" role="listbox"> 

    <?php 
        $db= new Connection();
        $db->from="slider_content";
        $db->select="*";
        $db->where=array("status"=>1);
        $db->limit=4;
        $db->type="slider Text";
        $db->qurry_etra=" order by rand() ";
        $result=$db->get_all_records()['items'];
        $db->connectionClose();
        $sno=0;
        foreach ($result as $key => $row) { ?>
        <div class="carousel-item item <?=$sno==0?'active':''?>">
        <div class="item-middle">
            <div class="middle-content">
                <div class="container">
                    <div class="banner-info">
                        <?php if($row['welcome_text']!='') { ?>
                        <h1 data-animation="animated fadeInDown" class=""><?=$row['welcome_text']?></h1>
                        <?php } 
                        if($row['main_text']!='') { ?>
                        <h2 data-animation="animated fadeInDown" class=""><?=$row['main_text']?></h2>
                        <?php } 
                        if($row['sub_text']!='') { ?>
                        <p data-animation="animated fadeInDown" class=""><?=$row['sub_text']?></p>
                        <?php }
                        if($row['view_more_link']!='') { ?>
                        <a href="<?=$row['view_more_link']?>" data-animation="animated fadeInDown" class="btn btn-primary">View More</a>
                        <?php } ?>
                    </div>                        
                </div><!-- /.container -->
            </div><!-- /.middle-content -->
        </div><!-- /.item-middle -->                   
        </div><!-- /.carousel-item -->  
    <?php $sno++; }    ?>
    </div><!-- /.carousel-inner -->
    <div class="container indicators-content">
        <ol class="carousel-indicators">
            <?php for($i=$sno;$i>0;$i--){ ?>
            <li data-target="#home-carousel" data-slide-to="<?=$i?>" class=""></li>
            <?php } ?>
        </ol>                   
    </div><!-- /.container -->                   
</div>
        

<div class="tr-promotion">
    <div class="container">
        <div class="row">

            <?php 
            $db= new Connection();
            $db->from="categories";
            $db->select="*";
            $db->where=array("cat_type"=>0,"status"=>1,"keep_home_page_slider"=>1);
            $db->limit=3;
            $db->type="slider Text";
            $db->qurry_etra=" order by rand() ";
            $result=$db->get_all_records()['items'];
            $db->connectionClose();
            $sno=0;
            foreach ($result as $key => $row) { 
                $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name'];?>

            <div class="col-md-4">
                <div class="promotion" style="background-image: url('./admin/<?=$row['image_url']?>');">
                    <div class="promotion-info">
                        <h1>Our <span><?=$row['name']?></span></h1>
                        <p><?=$row['seo_description']?></p>
                        <a href="/products/<?=$row['seo_name']?>" class="btn btn-primary" data-animation="animated fadeInDown">more</a>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>


<div class="tr-farmfood farmfood-one bg-image" style="background-image: url(images/bg/farmfood.jpg);">
    <div class="container">
        <div class="section-title">
            <h1>Hot deal  of the day</h1>
            <h2>We are organic <strong>farmfood</strong></h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="farmfood farmfood-left text-right">
                    <ul class="global-list">
                        <li class="media">
                            <div class="food-info media-body">
                                <h3>100% <strong>Organic</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                            <div class="icon ml-4">
                                <span class="icon icon-steak"></span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="food-info media-body">
                                <h3>Premium <strong>Quality</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                            <div class="icon ml-4">
                                <span class="icon icon-sandwich"></span>
                            </div>
                        </li>
                        <li class="media">
                            <div class="food-info media-body">
                                <h3>Organic <strong>Farm</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                            <div class="icon ml-4">
                                <span class="icon icon-seeds"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 push-md-4">
                <div class="farmfood farmfood-right">
                    <ul class="global-list">
                        <li class="media">
                            <div class="icon mr-4">
                                <span class="icon icon-bread-1"></span>
                            </div>
                            <div class="food-info media-body">
                                <h3>Fresh <strong>Breads</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="icon mr-4">
                                <span class="icon icon-cabbage"></span>
                            </div>
                            <div class="food-info media-body">
                                <h3>Harvest <strong>Everyday</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="icon mr-4">
                                <span class="icon icon-cauliflower"></span>
                            </div>
                            <div class="food-info media-body">
                                <h3>Super <strong>Healthy</strong></h3>
                                <p>Suspendisse ultricies nisi vel quam suscipit, et rutrum odio porttitor.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 pull-md-4">
                <div class="farmfood-image text-center">
                    <img src="images/img7.jpg" alt="Icon" class="img-fluid">
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>


<div class="tr-products popup-one section-padding">
    <div class="container">
        <div class="section-title">
            <h1>Discover our</h1>
            <h2>Popular <strong>farmfoom</strong></h2>
        </div>
        <div class="product-slider">
            <div class="products">
                <div class="row">
                <?php 
                $db= new Connection();
                $db->from="categories";
                $db->select="*";
                $db->where=array("cat_type"=>0,"status"=>1,"keep_home_page"=>1);
                $db->limit=12;
                $db->type="slider Text";
                $db->qurry_etra=" order by rand() ";
                $result=$db->get_all_records()['items'];
                $db->connectionClose();
                $sno=0;
                foreach ($result as $key => $row) {
                $row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name']; ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="product">
                            <a href="/products/<?=$row['seo_name']?>">
                                <span class="product-image">
                                    <img src="./admin/<?=$row['image_url']?>" alt="Image" class="img-fluid">
                                </span>
                                <span class="product-title">Our <span><?=$row['name']?></span></span>
                                <span class="price"><?=$row['seo_description']?></span>
                            </a>
                        </div><!-- /.product -->                                 
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tr-products products-two popup-two section-padding">
    <div class="container">
        <div class="section-title">
            <h1>Discover</h1>
            <h2>Our <strong>Branches</strong></h2>
        </div>
        <div class="product-slider">
            <div class="products">
                <div class="row">

                    <?php 
                    $db= new Connection();
                    $db->from="branches";
                    $db->select="*";
                    $db->where=array("status"=>1);
                    $db->limit=12;
                    $db->type="slider Text";
                    $db->qurry_etra=" order by branchorder desc ";
                    $result=$db->get_all_records()['items'];
                    $db->connectionClose();
                    $sno=0;
                    foreach ($result as $key => $row) {
                    //$row['seo_name']=$row['seo_name']==''?$row['id']:$row['seo_name']; 
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="product">

                                <span class="row">
                                    <span class="col-md-5">
                                        <span class="product-image">
                                            <img src="./admin/<?=$row['image_url']?>" alt="Image" class="img-fluid">
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
                        </div><!-- /.product -->                                 
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
