<?php $this->load->view('template/header'); ?>

<h1>Add New Customer</h1>

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
    	<div class="panel-heading">Add</div>
    	<div class="panel-body">
    	<!-- Form starts here -->
    	<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url()."customer/create/" ?>" name="save_customer_info" id="save_customer_info">
                  
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Name <span class="error">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" placeholder="Customer Name" id="customer_name" name="customer_name" class="form-control">
                      
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-sm-2 control-label" for="email">Email <span class="error">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" placeholder="Email" id="email" name="email" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="address">Address<span class="error">*</span></label>
                    <div class="col-sm-6">
                      <textarea rows="3" cols="10" placeholder="Address" id="address" name="address" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="zip">Zip<span class="error">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" placeholder="Zip" autocomplete="off" id="zip" name="zip" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="telephone">Telephone<span class="error">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" placeholder="Telephone" id="telephone" name="telephone" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="dob">Date of Birth<span class="error">*</span></label>
                    <div class="col-sm-6">
                    	<input type="text" placeholder="Date of Birth" id="dob" name="dob" class="form-control">
                    </div>
                  </div>
                  
                 
                  <div class="form-group" id="divButtonControls">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                      <button class="btn btn-primary" type="submit" name="submit">Save</button>
                      <a class="btn btn-warning" href="<?php echo base_url()."customer/" ?>">Cancel</a> </div>
                  </div>
                </form>
              </div>
    	<!-- Form ends here -->
    	</div>
    
	</section>

</div>

<?php $this->load->view('template/footer_start'); ?>
<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/add-customer-validations.js"></script>
<?php $this->load->view('template/footer_end'); ?>