<div  id="row">
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Add Economic Product</h4> -->
              <input type="hidden" name="form_type" value="finish">
              <div class="form-actions">
              </div>
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item active"> 
                  <a class="nav-link" data-toggle="tab" href="#fitting_tab" role="tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Fitting</span>
                  </a> 
                </li>
                
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#fixture_tab" role="tab"><span class="hidden-sm-up"></span> 
                    <span class="hidden-xs-down">Fixture</span>
                  </a> 
                </li>
            </ul>
            <!-- Tab panes -->
            <?php echo form_open_multipart('Economic_product/edit_economic_collection',$attributes=array('id'=>'create_productCollectionForm',"novalidate"=> "novalidate"));?>
            <input type="hidden" id="is_edit" value="1" class="hidden" name="">
            <div class="tab-content tabcontent-border">
                <div class="tab-pane p-20 active" id="fitting_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_economic_product_fitting.php'); ?>   
                  </div>
                </div>

                <div class="tab-pane p-20" id="fixture_tab" role="tabpanel">
                  <div class="table-responsive">
                    <?php $this->load->view('add_economic_product_fixture.php');?> 
                    <div id="validation_msg"></div>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                  </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>/assets/js/Steps_form/main.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_economic_product_collection.js"></script>
<style type="text/css">
  .question-main label{
    display: flex;
  }
  .details-row{
    display: -webkit-box;
  }
</style>

<!-- <script src="<?php echo base_url();?>/assets/js/grocery_newtabadd.js"></script> -->
<script src="<?php echo base_url();?>/assets/js/app/product_economic.js"></script>
<!-- <script src="<?php echo base_url();?>/assets/js/app/mixer.js"></script> -->
<script src="<?php echo base_url();?>/assets/js/app/index_popup.js"></script>