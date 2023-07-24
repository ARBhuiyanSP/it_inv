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
                        <h3 class="box-title">Receive Asset From Vendor</h3>
                        <div class="box-tools">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                                <?php
                                    $id = $_GET['id'];
                                    $sql    =   "select * from `inv_services` where `id`='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    $rowp=mysqli_fetch_array($result);
                                        $product_id=$rowp['assets_id'];
                                        $sql2   =   "select * from `ams_products` where `id`='$product_id'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $row=mysqli_fetch_array($result2);
                                
                                ?>
                                <div class="col-lg-4">
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
                                </div>
                                <div class="col-lg-8">
                                    <h3>Scan Below Code</h3>
                                    <img src="<?php echo $row['qr_image'] ?>" height="250" />
                                </div>
                            </div>
                            <h3 style="color:#049458;">Servicing Asset Receive From vendor</h3>
                            <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
                                <div class="row">
                                    <input name="a_id" type="hidden" value="<?php echo $rowp['id']; ?>" />
                                    <input name="assets_id" type="hidden" value="<?php echo $rowp['assets_id']; ?>" />
                                    <input name="assets_slno" type="hidden" value="<?php echo $rowp['assets_slno']; ?>" />
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <?php 
                                                $product_id= $row['id'];
                                                $sql2   = "SELECT * FROM product_assign WHERE product_id=$product_id ORDER BY id DESC LIMIT 1 ;";
                                                $result2 = mysqli_query($conn, $sql2);
                                                $row2=mysqli_fetch_array($result2);
                                                ?>
                                            <label>Vendor</label>
                                            <?php 
                                                $vendor_id = $rowp['vendor'];
                                                $sqlvendor  = "select * from `vendors` where `vendor_id`='$vendor_id'";
                                                $resultvendor = mysqli_query($conn, $sqlvendor);
                                                $rowvendor=mysqli_fetch_array($resultvendor);
                                            ?>
                                            <input name="employee_id" type="text" class="form-control" id="" value="<?php echo $rowvendor['vendor_name']; ?>" readonly />
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="id">Receive By</label>
                                            <?php 
                                                $employee_id = $_SESSION['logged']['office_id'];
                                                $sqlemployee    = "select * from `inv_employee` where `employeeid`='$employee_id'";
                                                $resultemployee = mysqli_query($conn, $sqlemployee);
                                                $rowemployee=mysqli_fetch_array($resultemployee);
                                            ?>
                                            <input type="text" class="form-control" id="" value="<?php echo $rowemployee["name"]; ?>" readonly required />
                                            <input name="receive_by" type="hidden" id="receive_by" value="<?php echo $rowemployee["employeeid"]; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label>Receive Date</label>
                                            <input name="receive_date" type="text" class="form-control" id="rndate" value="" size="30" autocomplete="off" required />
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="status" name="status" class="form-control" required >
                                                <option value="">Select Option</option>
                                                <option value="<?php echo $rowp['status'] ?>"><?php echo $rowp['status'] ?></option>
                                                <option value="active">Received With OK</option>
                                                <option value="disposed">Disposal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="ad">Handover Remarks</label>
                                            <textarea id="ad" name="ho_remarks" class="form-control" placeholder=""><?php echo $rowp['ho_remarks'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="ad">Receive Remarks</label>
                                            <textarea id="ad" name="recv_remarks" class="form-control" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $row2['id'] ?>" />
                                <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
                                <div class="row">
                                    <div class="col-md-10 mt-4">
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit" name="service_update_submit" style="width:100%"> Receive This Product</i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
 
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>


