<?php $this->load->view('template/header'); ?>

<h1>Customer Details</h1>

<div id="body" class="row">
	<ol class="breadcrumb">
        <li>
        	<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
        	<a href="<?php echo base_url()."customer/index" ?>"><i class="fa fa-list-ul"></i> List</a>
        </li>
    </ol>

    <section class="content">
    <div class="panel panel-primary">
    	<div class="panel-heading">View #<?php  echo $result->c_id; ?></div>
    	<div class="panel-body">
    		<div class="row">
			    <label class="col-sm-2 control-label">ID : </label>
			    <div class="col-sm-6"><?php  echo $result->c_id; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Name : </label>
			    <div class="col-sm-6"><?php  echo $result->c_name; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Email : </label>
			    <div class="col-sm-6"><?php  echo $result->c_email; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Address : </label>
			    <div class="col-sm-6"><?php  echo $result->c_address; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Zip : </label>
			    <div class="col-sm-6"><?php  echo $result->c_zip; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Telephone : </label>
			    <div class="col-sm-6"><?php  echo $result->c_telephone; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Date of Birth : </label>
			    <div class="col-sm-6"><?php  echo date("d-M-Y",strtotime($result->c_dob)); ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Is Active : </label>
			    <div class="col-sm-6"><?php  echo ($result->c_is_active==1)?"YES":"NO"; ?></div>
			</div>
			<div class="row">
			    <label class="col-sm-2 control-label">Added Date : </label>
			    <div class="col-sm-6"><?php  echo date("d-M-Y",strtotime($result->c_added_date)); ?></div>
			</div>
    	</div>
    </div>
    
	</section>

</div>


<?php $this->load->view('template/footer_start'); ?>
<?php $this->load->view('template/footer_end'); ?>