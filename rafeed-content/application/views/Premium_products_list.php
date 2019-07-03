    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/Premium_products_list_style.css">




<!-- cdnjs -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script> 
    String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
</script>

<h1 class="hide">Rafeed Products list page</h1>

<div class="row" style="margin: 0% 11%;  width:auto;">
<div class="col" style="float: right; font-weight: bold;">
    
  Category
<select id="soflow" onchange="get_product_by_category(this)">
    <?php 
    
 echo "<option value='0'>All</option>";
      foreach ($category_list as $key => $value) {
        echo "<option value='".$value['ID']."'>".$value['Name']."</option>";
      }
    ?>
  </select>

    
  </div>
</div> 
<div class="site-content">

  

  <div class="row" id="product_list" style="margin: 0% 11% !important;">
  <?php 
  foreach ($product as $key => $value) {
    $style_lastOne="";
    if($key == count($product) -1 ) {
      $style_lastOne="last-one-row";
    }
  }?>
  </div>

 
</div>




<script>
  $(document).ready(function(){
    //$('.filtering a')[0].click();
    get_product_by_category(null);
      
  });
  
  function get_product_by_category(elm=null) {; 
    var cat_id;
    if (elm!=null) {
      cat_id=elm.value;
    }
    else{
      cat_id=$('#soflow option:selected').val();
    }
    
    //ajax call
    var body_='';
    $.ajax({
        type: 'post',
        async: false,
        url: '../Premium_product_category_list/'+cat_id,
         success: function(result){
            var obj=JSON.parse(result);
            var length=obj.length;
            var style_lastOne="";
            $.each(obj, function (index, element) {
              style_lastOne="";
              /*if (index === (length - 1)) {
                style_lastOne="last-one-row";
              }*/
              if (index %4==0)
                body_+='<div class="row product-row last-one-row" style="margin: 0;padding: 10px 0;">';
              body_+='<div class="col-md-3">'+
                      '<a href="<?php echo $this->navigation->get_base_url();?>/Product/product_view/'+this["ID"]+'" class="product-card">'+ 
                      '<div class="img__wrap">'+
                       '<div class="color-img">';
   
              body_+= '</div>'+
                      '<img class="product-img img-fluid lazy" data-src="<?php echo $this->navigation->get_includes_url()?>/upload_files//Product/Premium/'+this['ID']+'/'+this['img']+'">'+
                      '<p class="product-description" style="font-size:1vw;">'+this['Family_description']+'</p>'+
                      '</div>'+
                      '<div>'+
                      '<p class="product-name">'+this['Family_name'].capitalizeFirstLetter()+'</p></div>'+
                      '</a></div>';
              if ((index+1) %4==0)
                body_+='</div>';
                
            });
         }
     });
    $('#product_list').html(body_);
                
    $(function() {
        $('.lazy').Lazy();
        console.log(this)
    });                                          
    
  }

console.clear();

const app = (() => {
  let body;
  let menu;
  let menuItems;

  const init = () => {
    body = document.querySelector('body');
    menu = document.querySelector('.menu-icon');
    menuItems = document.querySelectorAll('.nav__list-item');

    applyListeners();
  };

  const applyListeners = () => {
    menu.addEventListener('click', () => toggleClass(body, 'nav-active'));
  };

  const toggleClass = (element, stringClass) => {
    if (element.classList.contains(stringClass))
    element.classList.remove(stringClass);else

    element.classList.add(stringClass);
  };

  init();
})();
</script>
