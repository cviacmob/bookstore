<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
   <!--   <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> <a href="<?php echo $repair; ?>" data-toggle="tooltip" title="<?php echo $button_rebuild; ?>" class="btn btn-default"><i class="fa fa-refresh"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>-->
      <h1>Customer Groups</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Uploaded Images List</h3>
      </div>
      <div class="panel-body">
      <br>
      <button type="button" value="" class="addfrontimage">Front Image</button>
      <br>
      <br>
      <div class="">
      <button type="button" value="" class="addfrontimage">Back Image</button>
      </div>

      <div class="form">

       ISBN <input class="form-control input-lg" type="text" name="" value=""><br>
       Title <br> <input class="form-control input-lg" type="text" name="" value=""><br>
       Author <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Publisher <br> <input class="form-control input-lg" type="text" name="" value=""><br>
       No of Pages <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Cover type <br> <input class="form-control input-lg" type="text" name="" value=""><br>
       Description <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Sell Price <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Share Price <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Lend Price <br><input class="form-control input-lg" type="text" name="" value=""><br>
       Bid Price  <br><br> Minimum  <br> <input class="form-control input-lg" type="text" name="" value=""><br>  Maximum  <br> <input class="form-control input-lg" type="text" name="" value=""><br>
                     
      
      <input class = "btn btn-default " type="submit" value="ADD">

      </div>
         
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>