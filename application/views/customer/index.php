<?php $this->load->view('template/header'); ?>

<h1>Customers</h1>

	<div id="body">
		<div id="ajaxcustomerlist"></div>
	</div>

<?php $this->load->view('template/footer_start'); ?>

<script type="text/jscript">
var url = window.location.pathname;
var filename = SITEROOT + 'customer/gridlist/';
var grid_id = "#ajaxcustomerlist";

$(document).ready(function(){
  $(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: filename, ALLOWDELETE: true, COOKIE: "ajaxcustomerlist"});
});

setTimeout(function(){
  $('#sucess_msg').remove();
}, 5000);

</script>

<?php $this->load->view('template/footer_end'); ?>