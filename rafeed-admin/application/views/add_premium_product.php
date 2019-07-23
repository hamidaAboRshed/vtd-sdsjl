
<!-- class="col-lg-8" -->
<div  id="row">
    <div class="card">
        <div class="card-body">
              <input type="hidden" name="form_type" value="finish">
              <div class="form-actions">
              </div>
              <ul class="nav nav-tabs" role="tablist">
                 <li class="nav-item active"> 
                  <a class="nav-link" data-toggle="tab" href="#basic_tab" role="tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Basic Information</span>
                  </a> 
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#fitting_tab" role="tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Fitting</span>
                  </a> 
                </li>
                
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#fixture_tab" role="tab" id="add_fixture_tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Fixture</span>
                  </a> 
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#uploads_tab" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> 
                    <span class="hidden-xs-down">Uploads</span>
                  </a> 
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#mixer_tab" role="tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Mixer</span>
                  </a> 
                </li>
            </ul>
            <!-- Tab panes -->
            <?php echo form_open_multipart('Product/add_premium_family',$attributes=array('id'=>'create_productForm',"novalidate"=> "novalidate"));?>
            <div class="tab-content tabcontent-border">
                <div class="tab-pane p-20 active" id="basic_tab" role="tabpanel">
                  <div class="table-responsive">
                    
                    <?php $this->load->view('add_premium_product_series.php');?> 
                  </div>
                </div>

                <div class="tab-pane p-20" id="fitting_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_premium_product_fitting.php'); ?>   
                  </div>
                </div>
                
                <div class="tab-pane p-20" id="fixture_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_premium_product_fixture.php');?> 
                  </div>
                </div>
                <div class="tab-pane p-20" id="uploads_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_premium_product_upload'); ?>
                    <table class="table " id="uploads_tab_table">
                    </table>
                  </div>
                </div>
                <div class="tab-pane p-20" id="mixer_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_premium_product_mixer'); ?>
                    <button type="submit" class="btn btn-success" form="create_productForm"><i class="fa fa-check"></i> Save</button>
                  </div>
                </div>

            </div>
          </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>/assets/js/Steps_form/main.js"></script>
<style type="text/css">
  .question-main label{
    display: flex;
  }
  .details-row{
    display: -webkit-box;
  }
</style>
<!--  -->
<!-- <script src="<?php echo base_url();?>/assets/js/grocery_newtabadd.js"></script> -->
<script src="<?php echo base_url();?>/assets/js/app/product.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/mixer.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/index_popup.js"></script>