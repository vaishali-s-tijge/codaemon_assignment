<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->library('pagination');
	$config['base_url'] = base_url() . 'customer/gridlist/';
	$config['per_page'] = 5;
	$config['num_links'] = 5;
	$config['total_rows'] = $row_tr[0]->total_rows;
	$this->pagination->initialize($config);
?>

<form name="grid" id="grid">
  <input type="hidden" size="1" name="txt_column" id="txt_column" value="<?php echo stripslashes($this->input->get('txt_column')); ?>"/>
  <input type="hidden" size="1" name="txt_order_type" id="txt_order_type" value="<?php echo stripslashes($this->input->get('txt_order_type')); ?>"/>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-info">
          <div class="box-header">
            <div class="row">
              <div class="col-sm-6">
               		<div class="col-sm-3 col-xs-9" style="padding-left:0px;padding-right:0px;">
                    <select name="action" id="action"  class="form-control">
                      <option value="0">Bulk Action</option>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                      <option value="delete">Delete</option>
                    </select>
                  </div>
                  <div class="col-sm-3 col-xs-3">
                    <input type="button" class="btn btn-primary" value="Apply" id="btnaction" name="btnaction">
                  </div>
              </div>
              <div class="col-sm-6">
                <div class="pull-right">
                  <div class="inputbuttons pull-right">
                  	<div class="col-sm-3 col-xs-3">
                      <input type="button" class="btn btn-primary" value="Search" id="btn_search" name="btn_search" />
                    </div>
                    <div class="col-sm-4 col-xs-4">
                      <input type="reset" class="btn btn-primary" value="Reset Search" id="btn_reset_search" name="btn_reset_search" />
                    </div>
                    <div class="col-sm-3 col-xs-3" style="margin-left:5px;">
                      <a class="btn btn-warning" href="<?php echo base_url()."customer/add" ?>">Add New</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
          <!-- /.box-header -->
          
          <div class="box-body">
          	<?php 
			       if(strlen($action_message) > 0)
             {
				        echo '<div id="uberbar" class="alert '.$action_message_class.' uberbar">'.$action_message.'</div>';
			       }   
		        ?>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th abbr="c_id" width="5%"><div>ID</div></th>
                  <th abbr="c_name" width="10%"><div>Name</div></th>
                  <th abbr="c_email" width="10%"><div>Email</div></th>
                  <th abbr="c_address" width="15%"><div>Address</div></th>
                  <th abbr="c_zip" width="10%"><div>Zip</div></th>
                  <th abbr="c_telephone" width="10%"><div>Telephone</div></th>
                  <th abbr="c_dob" width="10%"><div>DOB</div></th>
                  <th abbr="c_is_active" width="5%"><div>Is Active</div></th>
                  <th abbr="c_added_date" width="10%"><div>Added Date</div></th>
                  <th width="5%">Action</th>
                </tr>
                <tr>
                  <th>
                    <input type="checkbox" name="checkall" id="checkall" value="1" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="c_id" id="c_id" value="<?php echo stripslashes($this->input->get('c_id')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo stripslashes($this->input->get('name')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo stripslashes($this->input->get('email')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="address" id="address" value="<?php echo stripslashes($this->input->get('address')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="zip" id="zip" value="<?php echo stripslashes($this->input->get('zip')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="telephone" id="telephone" value="<?php echo stripslashes($this->input->get('telephone')); ?>" size="3" />
                  </th>
                  <th>
                    <input class="form-control" type="text" name="dob" id="dob" value="<?php echo stripslashes($this->input->get('dob')); ?>" size="3" />
                  </th>
                  <th width="10%">
                    <select class="form-control" name="is_active" id="is_active">
                      <option value="">-Select-</option>
                      <option value="1" <?php echo ($this->input->get('is_active') == '1' ? 'selected="selected"' : "");?>>Active</option>
                      <option value="0" <?php echo ($this->input->get('is_active') == '0' ? 'selected="selected"' : "");?>>Inactive</option>
                    </select>
                  </th>
                  <th>
                    <input class="form-control" type="text" name="added_date" id="added_date" value="<?php echo stripslashes($this->input->get('added_date')); ?>" size="3" />
                  </th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
              <?php 
					     if(is_array($query->result()) && sizeof($query->result()) > 0){
						    foreach ($query->result() as $row):?>
                <tr>
                  <td>
                  	<input type="checkbox" name="id[]" id="id[]" value="<?php echo $row->c_id?>"/>
                  </td>
                  <td><?php echo $row->c_id; ?></td>
                  <td><?php echo $row->c_name; ?></td>
                  <td><?php echo $row->c_email; ?></td>
                  <td><?php echo $row->c_address; ?></td>
                  <td><?php echo $row->c_zip; ?></td>
                  <td><?php echo $row->c_telephone; ?></td>
                  <td><?php echo date("d-M-Y",strtotime($row->c_dob)); ?></td>
                  <td><?php if($row->c_is_active == '1') { echo "YES";} else {echo "NO";} ?></td>
                  <td><?php echo date("d-M-Y",strtotime($row->c_added_date)); ?></td>
                  <td align="center">
                  <a href="<?php echo base_url()."customer/view/".$row->c_id ?>" class="View" title="View"><span class="glyphicon glyphicon-eye-open"></span></a>
                 </td>
                </tr>
                <?php endforeach;
			         } else { ?>
                <tr>
                  <td align="center" class="listisempty" colspan="11">List is empty.</td>
                </tr>	
			         <?php } ?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-sm-12">
                <div class="box-header pull-right">
                  <div id="pagination-div-1" class="pagination pull-right">
                    <?php echo $this->pagination->create_links(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</form>
<script type="text/javascript">
$( "#added_date" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
$( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
</script>
	