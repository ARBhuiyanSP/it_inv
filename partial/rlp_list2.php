	<div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#tab-table1" data-toggle="tab">Table 1</a>
            </li>
            <li>
                <a href="#tab-table2" data-toggle="tab">Table 2</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-table1">
                <table id="myTable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn.</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane" id="tab-table2">
                <table id="myTable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn.</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
	
	<script>
$(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });
 
    $('table.table').DataTable({
        ajax: 'rlp_data.php',
        scrollY: 200,
        scrollCollapse: true,
        paging: false,
    });
 
    // Apply a search to the second table for the demo
    $('#myTable2').DataTable().search('New York').draw();
});
</script>