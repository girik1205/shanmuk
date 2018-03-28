<div class="container">
<div class="row">

  <div id="accordion" style="width: 100%;">

    <?php

    $db= new Connection();
    $db->from="careers";
    $db->select="*";
    $db->where=array("status"=>1);
    $db->limit=200;
    $db->type="slider Text";
    $result=$db->get_all_records()['items'];
    $db->connectionClose();
    $sno=1;

    foreach ($result as $key => $row) {  ?>

    <div class="card" style="    margin-top: 5px;margin-top: 5px;">
      <div class="card-header" id="heading<?=$sno?>"  data-toggle="collapse" data-target="#collapse<?=$sno?>"  aria-expanded="false"  aria-controls="collapse<?=$sno?>">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" style="width: 100%;">
            <span class="pull-left"><?=$row['name']?> #<?=$sno?></span>
            <span class="pull-right"> <?=$row['location']?> </span>
          </button>
        </h5>
      </div>

      <div id="collapse<?=$sno?>" class="collapse" aria-labelledby="heading<?=$sno?>" data-parent="#accordion">
        <div class="card-body" style="padding:10px;">
          <?=$row['career_desc']?>
        </div>
      </div>
    </div>
    <?php $sno++; } ?>
  </div>
</div>
</div>
