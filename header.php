<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from demo.themeregion.com/biotic/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Feb 2018 15:04:12 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Theme Region">
        <meta name="description" content="">

        <title><?=$sitename?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="<?=$webUrl?>css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?=$webUrl?>css/animate.css" >
        <link rel="stylesheet" href="<?=$webUrl?>css/fonts.css" >
        <link rel="stylesheet" href="<?=$webUrl?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=$webUrl?>css/magnific-popup.css">
        <link rel="stylesheet" href="<?=$webUrl?>css/slick.css">
        <link rel="stylesheet" href="<?=$webUrl?>css/structure.css">
        <link rel="stylesheet" href="<?=$webUrl?>css/main.css">
        <link id="preset" rel="stylesheet" href="<?=$webUrl?>css/presets/preset1.css">
        <link rel="stylesheet" href="<?=$webUrl?>css/responsive.css">

        <!-- font -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">


        <!-- icons -->
        <link rel="icon" href="<?=$webUrl?>images/ico/favicon.ico"> 
        <link rel="apple-touch-icon" sizes="144x144" href="<?=$webUrl?>images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?=$webUrl?>images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?=$webUrl?>images/ico/apple-touch-icon-72-precomposed.html">
        <link rel="apple-touch-icon" sizes="57x57" href="<?=$webUrl?>images/ico/apple-touch-icon-57-precomposed.png">
        <script src="<?=$webUrl?>js/jquery.min.js"></script>

        <!-- icons -->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Template Developed By ThemeRegion -->
    </head>
    <body>
	<?php ?>
        <div class="tr-menu">
            <nav class="navbar navbar-toggleable-md">
                <div class="container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="hidden-md-up">
                        <a class="navbar-brand" href="index-2.html"><img class="img-fluid mainlogo" src="<?=$webUrl?>images/logo.png" alt="Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav hidden-md-down">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?=$webUrl?>">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?=$webUrl?>about">About</a>
                            </li>
                            <li class="nav-item tr-dropdown"><a class="nav-link" href="#">Products</a>
                                <?php
                                    $db= new Connection();
            $db->from="products";
            $db->select=" count(products.id) as cnt,products.cat_type,categories.name,categories.seo_name ";
            $db->where=array("products.status"=>1);
            $db->limit=300;
            $db->type="catgories Text";
            $db->join=" join categories on categories.id=products.cat_type ";
            $db->qurry_etra=" group by products.cat_type ";
            $pmenu=$db->get_all_records()['items'];
            $db->connectionClose();
            //$pmenu=$db->get_all_records();
			
                                    $db->connectionClose();
                                    echo '<ul class="tr-dropdown-menu dropdown-left">';
                                    foreach ($pmenu as $key => $value) {
                                        echo '<li class="nav-item active"><a class="nav-link" href="'.$webUrl.'products/'.$value['seo_name'].'">'.$value['name'].'</a></li>';
                                    }
                                    echo '</ul>';
                                    ?>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>services">Services</a></li>
                            <li class="tr-middle-logo"><a class="navbar-brand" href="index-2.html"><img class="img-fluid mainlogo" src="<?=$webUrl?>images/logo.png" alt="Logo"></a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>branches">Branches</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>careers">Careers</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>gallery">Gallery</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>contactus">Contact Us</a></li>
                        </ul> 
                        <ul class="navbar-nav hidden-md-up">
                            <li class="nav-item tr-dropdown active">
                                <a class="nav-link" href="<?=$webUrl?>">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="shop-list.html">Products</a>
                                 <?php echo '<ul class="tr-dropdown-menu dropdown-left">';
                                    foreach ($pmenu as $key => $value) {
                                        echo '<li class="nav-item active"><a class="nav-link" href="'.$webUrl.'products/'.$value['seo_name'].'">'.$value['name'].'</a></li>';
                                    }
                                    echo '</ul>';?>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>services">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=$webUrl?>branches">Branches</a></li>
                            <li class="nav-item"><a class="nav-link" href="contactus">Contact Us</a></li>
                        </ul> 
                    </div><!-- /.navbar-collapse --> 
                    
                    <div class="find-option float-right " style="display: none;">
                        <ul class="global-list">
                            <li class="tr-search">
                                <div class="search-icon"><span class="icon icon-magnifying-glass"></span></div>
                                <div class="search-form">
                                    <form action="#" id="search" method="get">
                                        <input id="inputhead" name="search" type="text" placeholder="Type Your Words & Press Enter">
                                        <button type="submit"><span class="icon icon-magnifying-glass"></span></button>
                                    </form><!-- /form -->
                                </div><!-- /s form -->                            
                            </li>
                        </ul>                        
                    </div><!-- /.find-option -->

                </div><!-- /.container -->
            </nav>                                    
        </div><!-- /.tr-menu -->
