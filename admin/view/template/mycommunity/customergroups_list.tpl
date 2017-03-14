<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      
      <h1>Customer Groups</h1>
      
    </div>
  </div>
  <div class="container-fluid">
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Customer Groups List</h3>
      </div>
      
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  
                  <td class="text-center">Group Image</td>
                  <td class="text-center">Group Name</td>
                  <td class="text-center">Customer Name</td>         
                  <td class="text-center">Privacy</td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                <?php if ($clubs) { ?>
                <?php foreach ($clubs as $club) { ?>
                <tr>
                  
                  <td class="text-center"><?php if ($club['group_image']) { ?>
                    <img src="<?php echo $club['group_image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" />
                    <?php } else { ?>
                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                    <?php } ?></td>
                 
                  <td class="text-left"><?php echo $club['group_name']; ?></td>

                  <td class="text-left"><?php echo $club['customer_name']; ?></td>
                
                  <td class="text-left"><?php echo $club['privacy']; ?></td>
                  <td class="text-right"><a href="<?php echo $club['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        
      </div>
    </div>
  </div>
 
<?php echo $footer; ?>