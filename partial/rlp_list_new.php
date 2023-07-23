
  
  
    <div class="table-responsive">
		<div class="row">
			<div class="">
				<div class="col-md-2"></div>
				<div class="col-md-3">
					<input type="text" name="start_date" id="start_date" class="form-control" />
				</div>
				<div class="col-md-3">
					<input type="text" name="end_date" id="end_date" class="form-control" />
				</div>      
			</div>
			<div class="col-md-2">
				<input type="button" name="search" id="search" value="Search" class="btn btn-info" />
			</div>
			<div class="col-md-2"></div>
		</div>
    <br />
    <table id="order_data" class="table table-bordered">
     <thead>
      <tr>
       <th style="text-align:center;">Order ID</th>
       <th style="text-align:center;">RLP No</th>
       <th style="text-align:center;">Request Person</th>
       <th style="text-align:center;">RLP Status</th>
       <th style="text-align:center;">Reuest Date</th>
       <th style="text-align:center;">Project</th>
       <th style="text-align:center;">Action</th>
      </tr>
     </thead>
    </table>
    
   </div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#order_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"fetch_rlp.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date
    }
   }
  });
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Both Date is Required");
  }
 }); 
 
});



$(function () {
    $("#start_date").datepicker({
        inline: true,
        dateFormat: "yy-mm-dd",
        yearRange: "-50:+10",
        changeYear: true,
        changeMonth: true
    });
});
$(function () {
    $("#end_date").datepicker({
        inline: true,
        dateFormat: "yy-mm-dd",
        yearRange: "-50:+10",
        changeYear: true,
        changeMonth: true
    });
});

</script>