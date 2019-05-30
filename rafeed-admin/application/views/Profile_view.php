<div class="left col-lg-4">
    <div class="photo-left">
      <img id="pro_img" class="photo" src="<?php echo base_url();?>/assets/App_files/Employee_photos/<?php echo $output['Photo'];?>"/>
      
    </div>
    <h4 class="name"><?php echo $output['Full_name'];?></h4>
    <p class="info"><?php echo $output['Position'];?></p>
</div>
<div class="right col-lg-8">
    <ul class="nav">
      <li>Personal Information</li>
    </ul>
    <a href="<?php echo(site_url('Employee/edit_profile'));?>"><span class="follow">Edit</span></a>

    <div class="row gallery">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                   <!--  <tr>
                        <td>Country</td>
                        <td><?= $output['Country'];?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?=$output['City'];?></td>
                    </tr> -->
                    <tr>
                        <td>Address</td>
                        <td><?=$output['Address'];?></td>
                    </tr>
                    <tr>
                        <td>Mobile phone</td>
                        <td><?=$output['MobilePhone'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?=$output['Email'];?></td>
                    </tr>
                    <tr>
                        <td>QQ</td>
                        <td><?=$output['QQ'];?></td>
                    </tr>
                    <tr>
                        <td>Skype</td>
                        <td><?=$output['Skype'];?></td>
                    </tr>
                    <tr>
                        <td>wechat</td>
                        <td><?=$output['Wechat'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>