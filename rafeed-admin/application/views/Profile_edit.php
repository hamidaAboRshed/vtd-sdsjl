<div class="left col-lg-4">
    <div class="photo-left">
        <img id="pro_img" class="photo" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Employee_photos/<?php echo $output['Photo'];?>"/>
    </div>
    <h4 class="name"><?php echo $output['Full_name'];?></h4>
    <p class="info"><?php echo $output['Position'];?></p>
</div>
<div class="right col-lg-8">
    <ul class="nav">
      <li>Personal Information</li>
    </ul>
    <div class="row gallery">
        <div class="table-responsive">
            <?php echo form_open_multipart('Employee/update_employee');?>
            <table class="table">
                <tbody>
                    <!-- <tr>
                        <td>Country</td>
                        <td>
                            <select class="text_field" id="Country" name="Country"">
                                <option>select</option>
                                <?php foreach ($Countries as $rec) : ?>
                                    <?php echo '<option value="'.$rec['ID'].'" '.(($rec['Name'] ==  $output['Country']) ? ' selected="selected"' : '').'>'.$rec['Name'].'</option>'?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <select name="City" id="City" value="<?=$output['City'];?>">
                                
                            </select>
                        </td>
                    </tr> -->
                    <tr>
                        <td>Address</td>
                        <td>
                            <textarea name="Address"><?=$output['Address'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile phone</td>
                        <td>
                            <input type="text" name="MobilePhone" value="<?=$output['MobilePhone'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="Email" value="<?=$output['Email'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>QQ</td>
                        <td>
                            <input type="text" name="QQ" value="<?=$output['QQ'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Skype</td>
                        <td>
                            <input type="text" name="Skype" value="<?=$output['Skype'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>wechat</td>
                        <td>
                            <input type="text" name="Wechat" value="<?=$output['Wechat'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>
                            <input type="file" id="i_file" name="Photo" value="Browse..." class="btn-browse"></input>
                            <input type="button" onclick="reset_img()" id="i_reset" class="btn-reset"  value="Reset"></input>
                            <input type="checkbox" name="is_default" id="is_default" hidden="true"></input>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php echo form_submit('submit', 'Update',array("class"=>"btn btn-success","id"=>"submit"));?>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>/assets/js/lib/jquery/jquery.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>  --> 
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>   -->
<script type="text/javascript">  
  $(document).ready(function() {
     $("#Country").change(function(){  
         
     /*dropdown post *///  
     $.ajax({  
        url:"<?php echo site_url('Employee/build_drop_cities');?>",  
        data: {id:$(this).val()},  
        type: "POST",  
        success:function(data){ 
        $("#City").html(data);  
     }  
  });  
});
     
$('#i_file').click(function(){
    $('#is_default').removeAttr('checked')
});

$("#Country").change();  

});
function  reset_img () {
    /* Act on the event */
     $("#pro_img").fadeIn("fast").attr('src',"<?php echo base_url();?>assets/App_files/Employee_photos/default_photo.png");
     $('#is_default').attr('checked','checked');
}
</script>  