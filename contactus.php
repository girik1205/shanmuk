<?php 
if($_POST['action']=='contactus'){
    $db= new Connection();
    $db->table="contact_requests";
    $db->data=  array(
        'name'=>$_REQUEST['name'],
        'email'=>$_REQUEST['email'],
        'phone'=>$_REQUEST['mobile'],
        'message'=>$_REQUEST['message'],
        'status'=>1
        );
    if($db->insertData()){
        $success=true;
    }
    $db->connectionClose();

}
    $db= new Connection();
    $db->from="branches";
    $db->select="  * ";
    $db->where=array("mainbranch"=>1);
    $db->type="branchDetail";
    $row=$db->get_single_record();
    $db->connectionClose();
?>
<iframe class="tr-breadcrumb text-center bg-image" src="<?=$row['embaindmap']?>" width="100%" height="400px;"  style="padding: 0px;"></iframe>

<div class="form-content section-bg-white">
    <div class="row">
        <div class="col-md-4">
            <div class="contact-info">
                <h3>General inquirles</h3>
                <div class="media">
                    <div class="icon mr-5">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                        <a href="tel:<?=$row['phone']?>"><?=$row['phone']?></a>
                    </div>
                </div><!-- /.media -->
                <div class="media">
                    <div class="icon mr-5">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="media-body">
                        <span><a href="email:<?=$row['email']?>"><?=$row['email']?></a></span>
                    </div>
                </div><!-- /.media -->

                <div class="tr-address">
                    <span>Our Address</span>
                    <div class="media">
                        <div class="icon mr-5">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <address><?=$row['address']?></address>
                        </div>
                    </div><!-- /.media -->
                </div>

            </div><!-- /.contact-info -->
        </div>
        <div class="col-md-8 col-lg-7 offset-lg-1">
            <div class="contact-form">
                <h3>Request information</h3>
                <?php if($success){ ?>
                <div class="alert alert-success">
                <strong>Thanks.!</strong> Our Team will contact you shortly.
                </div>
                <?php } ?>
                <form class="tr-form" name="contact-form" method="post">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Your Name" pattern="[A-Za-z0-9.\s]{3,40}">
                            </div>                                         
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                <input type="email"  name="email" id="email" class="form-control" required="required" placeholder="Email Address"  pattern="[A-Za-z0-9.,@\-\s]{3,40}">
                            </div> 
                        </div>  
                        <div class="col-sm-4">  
                            <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                <input type="text"  name="mobile" id="mobile" class="form-control" required="required" placeholder="Mobile"  pattern="[6789][0-9]{9}" maxlength="10">
                            </div> 
                        </div>  
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group-addon"><i class="fa fa-comment" aria-hidden="true"></i></div>
                                <textarea name="message" class="form-control" required="required" rows="5" placeholder="Message" pattern="[A-Za-z0-9.,\s]{3,40}"></textarea>
                            </div> 
                            <input type="submit" class="btn btn-primary text-center pull-right" value="Send message">
                            <input type="hidden" class="form-control" name="action" value="contactus">
                        </div>          
                    </div><!-- /.row -->
                </form>                                      
            </div><!-- /.contact-form -->                                
        </div>
    </div><!-- /.row -->
</div>