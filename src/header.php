<!doctype html>

<html lang="en">
<head>
<title>SBS Lists</title>

<link rel="stylesheet" type="text/css" href="bootstrap-3.3.2/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/sbslist.css" />
<link rel="stylesheet" type="text/css" href="DataTables-1.10.5/media/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.2/css/bootstrap-theme.min.css">
<script src="js/jquery-1.11.2.min.js"></script>
<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
<script src="DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script src="js/sbslist.js"></script>

<script>
/*
$(document).ready(function() {
	$('#peopletbl tr').children(".lnv").tooltipster({
		animation: 'fade',
		delay: 200,
		theme: 'tooltipster-default',
		touchDevices: false,
		trigger: 'hover',
		speed: 0,
		contentAsHTML: true,
		content: 'Loading...',
		functionBefore: function(origin, continueTooltip) {

			// we'll make this function asynchronous and allow the tooltip to go ahead and show the loading notification while fetching our data
			continueTooltip();

			// next, we want to check if our data has already been cached
			if (origin.data('ajax') !== 'cached') {
				$.ajax({
					type: 'POST',
					url: 'example.php',
					data: {id:this.siblings(".idv").html()},
					success: function(data) {
						// update our tooltip content with our returned data and cache it
						origin.tooltipster('content', data).data('ajax', 'cached');
					}
				});
			}
		}
	});
});*/
</script>
<style>
.idv{ display: none; }
</style>

</head>
<body>
<div  class='header'>
<img src='images/UA_sbs_logo_stacked1_small.png' />
</div>