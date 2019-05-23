<h1 class="hide">Rafeed Products list page</h1>
<div class="" id="product_list" style="">
  <?php 
  foreach ($product as $key => $value) {
    $style_lastOne="";
    if($key == count($product) -1 ) {
      $style_lastOne="last-one-row";
    }
    echo '<div class="row product-row '.$style_lastOne.'" style="margin: 0;">
            <div class="col" style="text-align: center;">
              <img class="product-img" src="'.base_url().'/assets/images/small-product/'.$value["ID"].'.png" >
            </div>
            <div class="col" id="product-col-spec">
              <table class="tbl-specs-mini table-responsive">
                <tr style="vertical-align: bottom;">
                  <td>
                    <p class="product-name">'.$value["Name"].'</p>
                  </td>
                  <td>
                    <p class="product-subcat">'.$value["Lighting_Type"].'</p>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <p class="product-description">
                      '.$value["description"] .'
                    </p>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <code><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                      <defs>
                        <linearGradient id="badgeGradient">
                          <stop offset="0"/>
                          <stop offset="1"/>
                        </linearGradient>
                      </defs>

                      <g id="heading">
                        <polygon  id="follow-up" points="193.282,50.725 218.167,25.84 193.282,0.955 171.896,0.955 196.782,25.84 171.896,50.725 "/>
                          <a xlink:href= "'.$this->navigation->get_base_url().'/Product/Product_view/'.$value["ID"].'">
                            <polygon id="main-arrow" points="188.878,25.84 164.078,50.997 0,50.997 0,0.683 164.078,0.683 "/>      
                            <text id="title" transform="matrix(1 0 0 1 37.3193 31.2917)" fill="#6D6E71" font-family="Helvetica-Neue-UltLt" font-size="20">Read More...</text>
                        </a>
                      </g>

                    </svg></code>
                  </td>
                </tr>
              </table>
            </div>
          </div>';
  }?>
</div>