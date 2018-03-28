<div class="container">
<div class="row">

  <div id="accordion" style="width: 100%;">
    <?php
    $db= new Connection();
    $db->from="pages";
    $db->select="*";
    $db->where=array("status"=>1,"id"=>1);
    $db->limit=1;
    $db->type="slider Text";
    $result=$db->get_single_record();
    $db->connectionClose();
    echo $result['content'];
    ?>
  </div>
  </div>
</div>
