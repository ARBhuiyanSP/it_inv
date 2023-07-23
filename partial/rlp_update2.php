<?php
    $currentUserId  =   $_SESSION['logged']['user_id'];
    $rlp_id         =   $_GET['rlp_id'];    
    $rlp_details    =   getRlpDetailsData($rlp_id);   
    $rlp_info       =   $rlp_details['rlp_info'];
    $rlp_details    =   $rlp_details['rlp_details'];
?>
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-file"></i> RLP Details.
                <small class="pull-right">Priority: <?php echo getPriorityNameDiv($rlp_info->priority) ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-md-4 invoice-col">
            From
            <address>
                <strong>Name:&nbsp;<?php echo $rlp_info->request_person ?></strong><br>
                Designation:&nbsp;<?php echo getDesignationNameById($rlp_info->designation) ?><br>
                Division:&nbsp;<?php echo getDivisionNameById($rlp_info->request_division) ?><br>
                Department:&nbsp;<?php echo getDepartmentNameById($rlp_info->request_department) ?><br>
                Contact:&nbsp;<?php echo $rlp_info->contact_number ?><br>
                Email:&nbsp;: <?php echo $rlp_info->email ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-md-8 invoice-col">
            <div class="pull-right">
                <b>RLP NO: &nbsp;<span class="rlpno_style"><?php echo $rlp_info->rlp_no ?></span></b><br>
                <b>Request Date:</b> <?php echo human_format_date($rlp_info->created_at) ?><br>
            </div>            
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <form id="rlp_product_supplier_assign_form">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered" id="dynamic_field">
					<thead>
						<th width="25%">Item Description</th>
						<th width="10%">Qty </th>
						<th width="10%">Unit Price</th>
						<th width="15%">Amount</th>


						<th width="5%"></th>
					</thead>

					<tbody>
						<?php
						$productSerial = 0;
						if (isset($rlp_details) && !empty($rlp_details)) {
							foreach ($rlp_details as $key => $editDatas) {
								$productSerial++;
						?>
								<tr id="row<?php echo $editDatas->id; ?>">


									<td>
										<input type="text" name="description[]" id="" class="form-control" value="<?php echo (isset($editDatas->item_des) && !empty($editDatas->item_des) ? $editDatas->item_des : ''); ?>" required >
									</td>
									<td>
										<input type="text" name="quantity[]" id="quantity<?php echo $editDatas->id; ?>" onkeyup="sum(<?php echo $editDatas->id; ?>)" class="form-control" value="<?php echo (isset($editDatas->quantity) && !empty($editDatas->quantity) ? $editDatas->quantity : ''); ?>">
									</td>
									<!-- Unit Price -->
									<td>
										<input type="text" name="unit_price[]" id="unit_price<?php echo $editDatas->id; ?>" onkeyup="sum(<?php echo $editDatas->id; ?>)" class="form-control" value="<?php echo (isset($editDatas->unit_price) && !empty($editDatas->unit_price) ? $editDatas->unit_price : ''); ?>">
									</td>
									<!--  Amount -->
									<td>
										<input type="text" name="amount[]" id="sum<?php echo $editDatas->id; ?>" onkeyup="sum(<?php echo $editDatas->id; ?>)" class="form-control sale_amount" value="<?php echo (isset($editDatas->amount) && !empty($editDatas->amount) ? $editDatas->amount : ''); ?>">
									</td>






									<?php if ($key == 0) { ?>
										<!-- <td><button type="button" name="add" id="add" class="btn" style="background-color:#2e3192;color:#ffffff;">+</button></td> -->
									<?php } else { ?>
										<td><button type="button" name="remove" id="<?php echo $editDatas->id; ?>" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td>
									<?php } ?>
								</tr>
							<?php

							} //End of foreach


						} else {
							?>
							<tr>
                                            

                                            <td><input type="text" name="description[]" id="" class="form-control" required ></td>
								<td><input type="text" name="quantity[]" id="quantity0" class="form-control common_issue_quantity" required></td>
			  
								<td><input type="text" name="unit_price[]" id="unit_price0" onkeyup="sum(0)" class="form-control" ></td>
								<td><input type="text" name="amount[]" id="sum0" class="form-control sub_sell_amount" readonly ></td>


                                            <!-- <td><button type="button" name="add" id="add" class="btn" style="background-color:#2e3192;color:#ffffff;">+</button></td> -->
                                        </tr>
						<?php } ?>
					</tbody>
				</table>
				<table class="table table-bordered">
					<tr>
						<input type="hidden" class="form-control" maxlength="10" name="total_cur" id="allcur" value="<?php echo $rlp_info->totalamount; ?>" readonly />
						<td width="80%" style="text-align:right;"><b>Total Amount: </b></td>
						<td><input type="text" class="form-control" maxlength="10" name="total_amount" id="allsum" value="<?php echo $rlp_info->totalamount; ?>" readonly /></td>
					</tr>
				</table>
									
                             
				
				<script>
					var i = <?php echo $productSerial; ?>;
					$(document).ready(function() {
						$('#add').click(function() {
							i++;
							$('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="description[]" id="" class="form-control" required></td><td><input type="text" name="quantity[]" id="quantity' + i + '" class="form-control common_issue_quantity" required></td><td><input type="text" name="unit_price[]" id="unit_price' + i + '" onkeyup="sum(' + i + ')" class="form-control"></td><td><input type="text" name="amount[]" id="sum' + i + '" class="form-control" readonly ></td><td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td></tr>');
							$(".material_select_2").select2();

								$('#cur_price' + i + ', #unit_price' + i).change(function() {
									buy_amount(i)
								});
							$('#quantity' + i + ', #unit_price' + i).change(function() {
								sum(i)
							});
						});

						$(document).on('click', '.btn_remove', function() {
							var button_id = $(this).attr("id");
							$('#row' + button_id + '').remove();
							calculate_total_buy_amount();
							sum_total();
						});
					});


					function buy_amount(i) {
						let myQty = document.getElementById('quantity' + i).value;
						let myBuyPrice = document.getElementById('buy_price' + i).value;
						let subBuyAmount = parseFloat(myQty * myBuyPrice);
						if (!isNaN(subBuyAmount)) {
							document.getElementById('buy_amount' + i).value = subBuyAmount.toFixed(2);
						}
						calculate_total_buy_amount();
					}


					function sum(i) {
						let quantity1 = document.getElementById('quantity' + i).value;
						let unit_price1 = document.getElementById('unit_price' + i).value;
						let result = parseFloat(quantity1 * unit_price1);
						if (!isNaN(result)) {
							document.getElementById('sum' + i).value = result;
						}
						sum_total();
					}

					function calculate_total_buy_amount() {
						let subBuyAmount = $(".sub_buy_amount");
						let subBuyTotal = 0;

						for (let mySubValue = 0; mySubValue < subBuyAmount.length; mySubValue++) {
							subBuyTotal += parseFloat($("#" + subBuyAmount[mySubValue].id).val());
						}

						document.getElementById('allcur').value = subBuyTotal.toFixed(2);

					}

					function sum_total() {

						// sale_amount
						let subBuyAmount = $(".sale_amount");
						let subBuyTotal = 0;

						for (let mySubValue = 0; mySubValue < subBuyAmount.length; mySubValue++) {
							subBuyTotal += parseFloat($("#" + subBuyAmount[mySubValue].id).val());
						}
						document.getElementById('allsum').value = subBuyTotal.toFixed(2);

					}

					function calculate_profit_amount() {
						let subBuyAmount = $("#allcur").val();
						let subSellTotal = $("#netsale").val();
						let profitTotal = parseFloat((subSellTotal - subBuyAmount));



						document.getElementById('profitamount').value = profitTotal.toFixed(2);
					}

					$(function() {
						$("#allsum, #discount").keyup(function() {
							$("#netsale").val(+$("#allsum").val() - +$("#discount").val());
							calculate_profit_amount();
						});
					});

					$(function() {
						$("#netsale, #paid").keyup(function() {
							$("#due").val(+$("#netsale").val() - +$("#paid").val());
						});
					});
				</script>

            </div>
            <!-- /.col -->
        </div>
    </form>
    <!-- /.row -->
    <?php
    $role       =   get_role_group_short_name();
    
    if(is_super_admin($currentUserId)){
        include 'rlp_update_view_sa.php';
    }elseif($role    ==  "member"){
        include 'rlp_update_view_member.php';
    }elseif($role    ==  "dh"){
        include 'rlp_update_view_dh.php';
    }elseif($role    ==  "ab"){
        include 'rlp_update_view_ab.php';
    }else{
        include 'rlp_update_view_dh.php';
    }
    ?>
</section>
<!-- /.content -->
<div class="clearfix"></div>