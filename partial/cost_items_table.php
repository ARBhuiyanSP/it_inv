<table class="table table-bordered" id="dynamic_field">
	<thead>
		<th width="35%">Spare Parts Name<span class="reqfield"> *</span></th>
		<th width="15%">Qty<span class="reqfield"> *</span></th>
		<th width="15%">Unit<span class="reqfield"> *</span></th>
		<th width="15%">Rate<span class="reqfield"> *</span></th>
		<th width="15%">Amount</th>
		<th></th>
	</thead>
	<tbody>
		<tr>
			<td><input type="text" name="material_name[]" id="material_name0" class="form-control" required ></td>
			<td><input type="number" name="quantity[]" id="quantity0" onkeyup="sum(0)" class="form-control" required></td>
			<td>
				<select class="form-control" name="unit[]">
					<option value="PCS">PCS</option>
					<option value="NOS">NOS</option>
					<option value="GALLON">GALLON</option>
					<option value="SET">SET</option>
					<option value="INCH">INCH</option>
					<option value="KG">KG</option>
					<option value="LTR">LTR</option>
					<option value="FEET">FEET</option>
					<option value="PACKET">PACKET</option>
				</select>
			</td>
			<td><input type="number" name="unit_price[]" id="unit_price0" onkeyup="sum(0)" class="form-control" required></td>
			<td><input type="text" name="totalamount[]" id="sum0" class="form-control" readonly></td>
			<td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered">
	<tr>
		<td colspan="3" style="text-align:right;">Total Amount</td>
		<td><input type="text" class="form-control" maxlength="30" name="sub_total_amount" id="allsum" readonly /></td>
	</tr>
</table>
<script>
	var i = 0;
	$(document).ready(function () {
		$('#add').click(function () {
			i++;
			$('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="material_name[]" id="material_name' + i + '" class="form-control" required ></td><td><input type="number" name="quantity[]" id="quantity' + i + '" onkeyup="sum(' + i + ')" class="form-control" required></td><td><select class="form-control" name="unit[]"><option value="PCS">PCS</option><option value="NOS">NOS</option><option value="GALLON">GALLON</option><option value="SET">SET</option><option value="INCH">INCH</option><option value="KG">KG</option><option value="LTR">LTR</option><option value="FEET">FEET</option><option value="PACKET">PACKET</option></select></td><td><input type="number" name="unit_price[]" id="unit_price' + i + '" onkeyup="sum(' + i + ')" class="form-control" required></td><td><input type="text" name="totalamount[]" id="sum' + i + '" class="form-control" readonly ></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove btn-warning">X</button></td></tr>');
			$(".material_select_2").select2();
			$('#quantity' + i + ', #unit_price' + i).change(function () {
				sum(i)
			});
		});

		$(document).on('click', '.btn_remove', function () {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
			sum_total();
		});
	});

	$(document).ready(function () {
		//this calculates values automatically 
		sum(0);
	});

	function sum(i) {
		var quantity1 = document.getElementById('quantity' + i).value;
		var unit_price1 = document.getElementById('unit_price' + i).value;
		var result = parseFloat(quantity1) * parseFloat(unit_price1);
		if (!isNaN(result)) {
			document.getElementById('sum' + i).value = result;
		}
		sum_total();
	}
	function sum_total() {
		var newTot = 0;
		for (var a = 0; a <= i; a++) {
			aVal = $('#sum' + a);
			if (aVal && aVal.length) {
				newTot += aVal[0].value ? parseFloat(aVal[0].value) : 0;
			}
		}
		document.getElementById('allsum').value = newTot.toFixed(2);
	}
</script>