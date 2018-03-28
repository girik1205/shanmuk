<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php

$db= new Connection();
$db->from="branches";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1);
$db->type="categories data";
$branches=$db->get_single_record()['cnt'];
$db->connectionClose();

$db= new Connection();
$db->from="categories";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1,"cat_type"=>0);
$db->type="categories data";
$categories=$db->get_single_record()['cnt'];
$db->connectionClose();

$db= new Connection();
$db->from="products";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1);
$db->type="categories data";
$products=$db->get_single_record()['cnt'];
$db->connectionClose();

$db= new Connection();
$db->from="services";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1);
$db->type="categories data";
$services=$db->get_single_record()['cnt'];
$db->connectionClose();

$db= new Connection();
$db->from="product_enq";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1);
$db->type="categories data";
$product_enq=$db->get_single_record()['cnt'];
$db->connectionClose();

$db= new Connection();
$db->from="contact_requests";
$db->select=" count(*) as cnt ";
$db->where=array("status"=>1);
$db->type="categories data";
$contact_requests=$db->get_single_record()['cnt'];
$db->connectionClose();

?>


<div class="row">
    <div class="col-lg-4 col-md-4 ">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$branches?></div>
                        <div>Branches!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>branches">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$categories?></div>
                        <div>Categories!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>categories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$products?></div>
                        <div>Products!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>products">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$services?></div>
                        <div>Services!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>services">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>    <div class="col-lg-4 col-md-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$product_enq?></div>
                        <div>Product Enquires!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>prod_enq_req">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-comments  fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge"><?=$contact_requests?></div>
                        <div>Contact!</div>
                    </div>
                </div>
            </div>
            <a href="<?=$basepath?>contact_req">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>