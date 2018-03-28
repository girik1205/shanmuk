<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$sitename?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$webUrl?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=$webUrl?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$webUrl?>dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?=$webUrl?>dist/css/styles.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=$webUrl?>vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$webUrl?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=$webUrl?>vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$webUrl?>vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=$webUrl?>vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=$webUrl?>vendor/raphael/raphael.min.js"></script>
    <script src="<?=$webUrl?>vendor/morrisjs/morris.min.js"></script>
    <script src="<?=$webUrl?>data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=$webUrl?>dist/js/sb-admin-2.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('displayTimer').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>

<body onload="startTime()">

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <div class="pull-left">
                        <a class="navbar-brand" href="index.php?page=home"><?=$sitename?> </a>
                    </div>
                    <div class="pull-right" style="    right: 0;position: absolute;padding: 20px;">
                       Hi, <strong><?=$_SESSION['name']?></strong> welcome to <?=$sitename?>  <span id="displayTimer" style="    float: right;
    background: #5cb85c;
    color: red;
    font-size: 18px;
    padding: 5px;
    margin-left: 20px;
    margin-top: -12px;"></span> 
                    </div>


                </div>
            </div>
            <!-- /.navbar-header -->

           
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                            <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <img src="http://antarvedisrilakshminarasimhaswamy.com/new/assrts/images/swamipic.jpg" class="img-responsive" >    
                            </div>
                             /input-group </li>-->
                        
                        <li>
                            <a href="<?=$basepath?>home" class="<?=$_REQUEST['page']=='home'?'active':''?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                           <a href="<?=$basepath?>products"  class="<?=$_REQUEST['page']=='products'?'active':''?>"><i class="fa fa-eye fa-fw"></i> Products</a>
						   <li>
                           <a href="<?=$basepath?>categories"  class="<?=$_REQUEST['page']=='categories'?'active':''?>"><i class="fa fa-dashboard fa-fw"></i>Categories</a>
						   </li>
                           <li>
                           <a href="<?=$basepath?>services"  class="<?=$_REQUEST['page']=='services'?'active':''?>"><i class="fa fa-eye fa-fw"></i>Services</a>
                           </li>
						   
                         <li>
                           <a href="<?=$basepath?>slider_text"  class="<?=$_REQUEST['page']=='slider_text'?'active':''?>"><i class="fa fa-dashboard fa-fw"></i> Slider Text</a>
						   </li>
                           <li>
                           <a href="<?=$basepath?>branches"  class="<?=$_REQUEST['page']=='branches'?'active':''?>"><i class="fa fa-home fa-fw"></i> Branches</a>
                           </li>

                            <li>
                           <a href="<?=$basepath?>contact_req"  class="<?=$_REQUEST['page']=='contact_req'?'active':''?>"><i class="fa fa-eye fa-fw"></i> Contact Req</a>
                           </li>

                             <li>
                           <a href="<?=$basepath?>prod_enq_req"  class="<?=$_REQUEST['page']=='prod_enq_req'?'active':''?>"><i class="fa fa-eye fa-fw"></i> Enqiries Req</a>
                           </li>

						 <!--  
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Add Pooja</a>
                                </li>
                                <li>
                                    <a href="#">Edit Pooja</a>
                                </li>
                               
                            </ul>
                        </li>-->
                         <li>
                           <a href="<?=$basepath?>logout"><i class="fa fa-dashboard fa-fw"></i> Logout</a>
                           </li>
                           
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        

        <div id="page-wrapper">
            <br>

