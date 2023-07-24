<?php include 'header.php';
    $_SESSION['activeMenu'] =   'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header)
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>Service Area</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Service Area</li>
        </ol>
    </section>  -->

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Assets List</h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="service_entry.php"><i class="fa fa-user-plus"></i> New Entry</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="" action="" id="warehouse_stock_search_form" method="GET">
                                    <div class="row" id="div1" style="padding-bottom:10px;">  
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="todate">Select Asset For Disposal</label>
                                                <select name="id" class="form-control material_select_2" required >
                                                    <option value="">Select Asset</option>
                                                    <?php
                                                    $sqlvs="SELECT * FROM `ams_products` WHERE `status`='active'";
                                                    $resultvs = mysqli_query($conn,$sqlvs);
                                                    while($rowvs = mysqli_fetch_array($resultvs)) {
                                                        if($_GET['id'] == $rowvs['id']){
                                                        $selected   = 'selected';
                                                        }else{
                                                        $selected   = '';
                                                        }
                                                        
                                                    ?>
                                                    <option value="<?php echo $rowvs['id']; ?>" <?php echo $selected; ?>><?php echo $rowvs['sl_no'] ?> || <?php echo $rowvs['item_name'] ?> || <?php echo $rowvs['model'] ?> || <?php echo $rowvs['assets_description'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>      
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="todate">.</label>
                                                <button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php if(isset($_GET['submit'])){
                                    $id = $_GET['id'];
                                    $sql    =   "select * from `ams_products` where `id`='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row=mysqli_fetch_array($result); ?>
                         

<table style="" class="table table-bordered">
                                    <tr>
                                        <th>Item Name:</th>
                                        <td><?php echo $row['item_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Brand:</th>
                                        <td><?php echo $row['brand'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Model:</th>
                                        <td><?php echo $row['model'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>RLP No:</th>
                                        <td><?php echo $row['rlp_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Country Origin:</th>
                                        <td><?php echo $row['origin'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Vendor Name:</th>
                                        <td><?php echo $row['vendor_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Purchase Date:</th>
                                        <td><?php echo $row['puchase_date'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Custody:</th>
                                        <td><?php echo $row['custody'] ?></td>
                                    </tr>
                                </table>
                                <h3 style="color:red;">Want To Dispose This Product ?</h3>
                                <form action="" method="post" onsubmit="showFormIsProcessing('receive_entry_form');">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Disposal Date</label>
                                                <input name="disposal_date" type="text" class="form-control" id="mrr_date" value="" size="30" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Disposal Value</label>
                                                <input name="disposal_value" type="text" class="form-control" id="" value="" size="30" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label for="id">Disposal By</label>
                                                <?php 
                                                    $employee_id = $_SESSION['logged']['employee_id'];
                                                    $sqlemployee    = "select * from `employees` where `employee_id`='$employee_id'";
                                                    $resultemployee = mysqli_query($conn, $sqlemployee);
                                                    $rowemployee=mysqli_fetch_array($resultemployee);
                                                ?>
                                                <input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
                                                <input name="disposal_by" type="hidden" id="disposal_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="ad">Disposal Reason</label>
                                                <textarea id="ad" name="reason" class="form-control" placeholder="Disposal Reason"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="ad">Remarks</label>
                                                <textarea id="ad" name="remarks" class="form-control" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12" style="padding-top:10px">
                                            <input type="hidden" name="store_id" value="<?php echo $row['current_store']; ?>" />
                                            <input type="hidden" name="product_id" value="<?php echo $id; ?>" />
                                            <button class="btn btn-danger" type="submit" name="disposal_submit" style="width:100%"> Dispose This Product</i></button>
                                        </div>
                                    </div>
                                    
                                </form>
                                 
                        <?php }else{ ?>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive data-table-wrapper">
                                <table id="receive_data_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="10%">SRV No</th>
                                            <th width="10%">Asset ID</th>
                                            <th width="10%">
                                                <select name="vendors" id="vendors" class="form-control select2">
                                                    <option value="">Vendor Search</option>
                                                    <?php 
                                                    $query = "SELECT * FROM vendors ORDER BY vendor_name ASC";
                                                    $result = mysqli_query($conn, $query);
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                        echo '<option value="'.$row["vendor_id"].'">'.$row["vendor_name"].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </th>
                                            <th width="15%">Handover Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                       <?php  } ?>
                      
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
 <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_receive_data();

 function load_receive_data(is_vendors)
 {
  var dataTable = $('#receive_data_list').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch/fetch_service_table.php",
    type:"POST",
    data:{is_vendors:is_vendors}
   },
   "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            if ( aData[4] == "active" )
            {
                $('td', nRow).css('background-color', '#218a5c');
                $('td', nRow).css('color', '#fff');
            }else{
                $('td', nRow).css('background-color', '#b01a33');
                $('td', nRow).css('color', '#fff');
            }
        },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#vendors', function(){
  var vendors = $(this).val();
  $('#receive_data_list').DataTable().destroy();
  if(vendors != '')
  {
   load_receive_data(vendors);
  }
  else
  {
   load_receive_data();
  }
 });
});
</script>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>


