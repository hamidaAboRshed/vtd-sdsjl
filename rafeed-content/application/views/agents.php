<style type="text/css">
.accordion {
  /*background-color: #eee;*/
  color: #ec1a3b;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
  border-top: 1px solid #ec1a3b;
  background-color: transparent;
  font-family: Helvetica-Neue-Bd;
  font-size: 18px;
}


/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
  /*background-color: #ccc;*/
}
.accordion:focus{
    outline: none;
} 
/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
}
.company-name{
	font-family: Helvetica-Neue-Bd;
}
.company-classification{
	font-size: 15px;
	color: #8c8c8c;
    font-style: italic;
}
#cover_page{
  text-align: center;
}
</style>
<div class="about-padding"><!-- style="padding: 20px 200px;" -->
	<div id="cover_page">
		<img src="<?php echo base_url();?>/assets/images/backgrounds/agent.png">
	</div>
	<h1>
		Rafeed Agent
	</h1>
	<p>Here you can find a list of our distributors and agents in Middle East and Arab World countries</p>

	<button class="accordion">Lebanon</button>
	<div class="panel">
	  <p class="company-name">Advanced Smart Systems LLC.</p>
	  <p>Jounieh highway , Haret Sakher 1086 </p>
	  <p>Tell : 03105453</p>
	</div>

	<button class="accordion">Kingdom of Saudi Arabia</button>
	<div class="panel">
	  <p  class="company-name">First Lighting Co. / <span class="company-classification">  Premium series</span></p>
	  <p>Riyadh Mecca Road</p>
	  <p>Tell : 800 116 0 616</p>
	  <br/>
	  <p  class="company-name">Tatawar Maana Est. / <span class="company-classification">  Economic series</span></p>
	  <!-- <p>address</p> -->
	  <p>Tell : 920011035</p>
	</div>

	<button class="accordion">Jordan</button>
	<div class="panel">
	  <p  class="company-name">Jordanian Sama Rafeed Co.</p>
	  <p>Jordan, Amman</p>
	  <p>Tell : 079 6927128</p>
	</div>

	<button class="accordion">United Arab Emirates</button>
	<div class="panel">
	  <p  class="company-name">AB Tech Co.</p>
	  <p>Dubai Al Muraqqabat Bakhit Building</p>
	  <p>Tell : 04 2664495</p>

	</div>
</div>
<div class="blank-row-10x"></div>
<script type="text/javascript">
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
	    /* Toggle between adding and removing the "active" class,
	    to highlight the button that controls the panel */
	    this.classList.toggle("active");

	    /* Toggle between hiding and showing the active panel */
	    var panel = this.nextElementSibling;
	    if (panel.style.display === "block") {
	      panel.style.display = "none";
	    } else {
	      panel.style.display = "block";
	    }
	  });
	}
</script>

<!-- 
<link rel="stylesheet" href="<?php echo base_url();?>/assets/swanky-little-accordian-list/css/style.css">

 <div class='title'>
  <h1>
    Swanky little accordian list
  </h1>
  <h2>
    Made in pure CSS, click on the items to see it in action!
  </h2>
</div>
<div class='wrapper'>
  <input id='pictures' type='checkbox'>
  <label for='pictures'>
    <p>Documentation & more</p>
    <div class='lil_arrow'></div>
    <div class='content'>
      <ul>
        <li>
          <a href='#'>Design briefs</a>
        </li>
        <li>
          <a href='#'>Non Disclosure</a>
        </li>
        <li>
          <a href='#'>Company Brochure</a>
        </li>
      </ul>
    </div>
    <span></span>
  </label>
  <input id='jobs' type='checkbox'>
  <label for='jobs'>
    <p>Upcoming Jobs</p>
    <div class='lil_arrow'></div>
    <div class='content'>
      <ul>
        <li>
          <a href='#'>Weekly Forecast</a>
        </li>
        <li>
          <a href='#'>Timescales</a>
        </li>
        <li>
          <a href='#'>Quotes</a>
        </li>
      </ul>
    </div>
    <span></span>
  </label>
  <input id='events' type='checkbox'>
  <label for='events'>
    <p>Events & Task Management</p>
    <div class='lil_arrow'></div>
    <div class='content'>
      <ul>
        <li>
          <a href='#'>Calendar</a>
        </li>
        <li>
          <a href='#'>Important Dates</a>
        </li>
        <li>
          <a href='#'>Someting Event related</a>
        </li>
      </ul>
    </div>
    <span></span>
  </label>
  <input id='financial' type='checkbox'>
  <label for='financial'>
    <p>Invoicing & financial</p>
    <div class='lil_arrow'></div>
    <div class='content'>
      <ul>
        <li>
          <a href='#'>Invoicing Templates</a>
        </li>
        <li>
          <a href='#'>Invoice Archives</a>
        </li>
        <li>
          <a href='#'>Send Invoice</a>
        </li>
      </ul>
    </div>
    <span></span>
  </label>
  <input id='settings' type='checkbox'>
  <label for='settings'>
    <p>System Settings</p>
    <div class='lil_arrow'></div>
    <div class='content'>
      <ul>
        <li>
          <a href='#'>User Settings</a>
        </li>
        <li>
          <a href='#'>Edit Profile</a>
        </li>
        <li>
          <a href='#'>Do something cool</a>
        </li>
      </ul>
    </div>
    <span></span>
  </label>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="<?php echo base_url();?>/assets/swanky-little-accordian-list/js/index.js"></script> -->