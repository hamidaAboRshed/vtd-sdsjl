<?php foreach ($this->session->userdata('navdata') as $key => $value) {
	if($value['active']==1){
		echo '
			<div class="nav-scroller-wrapper">
			  <div class="nav-scroller-logo">
			  	<img src="'. base_url() .'/assets/images/logo/series/'.$value["logo"] .'">
			  </div>

			  <div class="nav-scroller nav-scroller--demo-links-sm">

			    <nav class="nav-scroller-nav">
			      <div class="nav-scroller-content"  id="cat-item" style="align-items: baseline;">';
            $class_name="cat-icon";
            if($this->session->userdata('is_premium')==1){
                $class_name="cat-icon-p";
            }
			      if($value['ID']!=4 && $value['ID']!=5)
					foreach ($value["category"] as $key2 => $value2) {
						echo '
			        <a class="nav-scroller-item '.($value2["active"]==1? "active":"").'" href="'.$this->navigation->get_base_url()."/Product/Product_category_list/".$value2["ID"].'">
		                    <span><i class="icon-'.$value2["icon"].' '.$class_name.' "></i></span>
		                    
		                    <span>'.$value2["Name"].'</span>
		                </a>';
			    }
			     echo ' </div>
			    </nav>

			    <button class="nav-scroller-btn nav-scroller-btn--left" aria-label="Scroll left">
			      <svg class="icon" width="18" height="18" viewBox="0 0 21 32" fill="#ddd">
			      <path d="M0 16l4.736-4.768 11.264-11.232 4.736 4.736-11.232 11.264 11.232 11.264-4.736 4.736-11.264-11.264z"></path></svg>
			    </button>

			    <button class="nav-scroller-btn nav-scroller-btn--right" aria-label="Scroll right">
			      <svg class="icon" width="18" height="18" viewBox="0 0 21 32" fill="#ddd">
			      <path d="M0 27.264l11.264-11.264-11.264-11.264 4.736-4.736 11.264 11.232 4.736 4.768-16 16z"></path></svg>
			    </button>

			  </div>
			</div>';

}
}?>
