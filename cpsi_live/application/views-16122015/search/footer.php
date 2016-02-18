<!-- Core Scripts - Include with every page -->
<script src="<?= base_url("assets/js/jquery-1.10.2.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-ui.js"); ?>"></script>
<script src="<?= base_url("assets/js/jquery-ui-1.10.4.custom.js"); ?>"></script>
<script src="<?= base_url("assets/js/functions.js"); ?>"></script>


<!-- Form validator -->
<script src="<?= base_url("assets/js/jquery.validate.js"); ?>"></script>
<script src="<?= base_url("assets/js/additional-methods.js"); ?>"></script>


<!-- Table sorter 2.0 -->
<script src="<?= base_url("assets/js/jquery.tablesorter.js"); ?>"></script>

<!--<script>
$(document).ready(function() { 
    // call the tablesorter plugin 
//    $("#results").tablesorter({ 
//        // sort on the first column and third column, order asc 
//        sortList: [[0,0],[2,0]] 
//    }); 
//});
</script>-->
<!--Pagination-->
<script  src="<?= base_url("assets/js/jquery.dataTables.min.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/jquery.dataTables.min.css"); ?>"/>

<script>
$(document).ready(function(){
    $('#results').DataTable();
});
</script>

<!--pagination end--> 
<script>
//js code after document is ready
//Search autocomplete
$("#student").autocomplete({
	minLength: 1,
	source: function(req, add){
		$.ajax({
			url: '<?= base_url("search/student_search/students") ?>', //Controller where search is performed
			dataType: 'json',
			type: 'POST',
			data: req,
			success: function(data){
				if(data.response =='true'){
				   add(data.message);
				}
			}
		});
	}
});

$("#main-search").autocomplete({
	minLength: 3,
	source: function(req, add){
		$.ajax({
			url: '<?= base_url("search/student_search/students") ?>', //Controller where search is performed
			dataType: 'json',
			type: 'POST',
			data: req,
			success: function(data){
				if(data.response =='true'){
				   add(data.message);
				}
			}
		});
	}
});
</script>

<script type="text/javascript">
$(function () {
    $('#student').keypress(function (event) {
    });
    $('#main-search').keypress(function (event) {
    });
});
</script>
		<footer class="footer">
			<p>&copy; <?= date("Y") ?> Anne Arundel County Health Department</p>
			<p>Unauthorized or improper use of this system is prohibited.</p>
		</footer>
	</div>
</body>
</html>