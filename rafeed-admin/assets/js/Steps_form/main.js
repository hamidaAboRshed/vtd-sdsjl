$(document).ready(function(){

	//Ckech mark SVG icon point
	var svg_valid_icon = "21.4,4.7 21.4,4.7 21.4,4.7 18.6,7.5 18.6,7.5 8.7,17.4 3,11.7 0,14.5 5.9,20.2 8.7,23 20.2,11.5 24.2,7.5";
	
	//Arrow SVG icon point
	var svg_arrow_icon = "17.4,8.7 17.4,8.7 8.7,0 5.9,2.8 14.6,11.5 8.7,17.4 8.8,17.3 5.8,20.1 5.9,20.2 8.7,23 20.2,11.5 20.2,11.5";
	//var preveious_svg_arrow_icon = "8.6,14.3 8.6,14.3 17.3,23 20.1,20.2 11.4,11.5 17.3,5.6 17.2,5.7 20.2,2.9 20.1,2.8 17.3,0 5.8,11.5 5.8,11.5"

	//var step_name="_series";
	var step_name=$('#initial_step').val();
	//var step_name="_fixture";
	
	//Form steps number
	var list_elem_count = $("#steps"+step_name+" li.form-group").length;
	
	//Steps navigation position
	var navigation_pos;
	
	//Enable/Disable consecutive click/keypress event
	var clickable_btn = true;

	var back_action=true;

	initForm();
	//$('input[type="number"]').attr("value", 0);
	//$('input[type="number"]').val(null);

	function initForm(){
		add_navigation();

		var next_step_btn_width = $("#navigation"+step_name+" li.current_nav").outerWidth();

		var navigation_parent_width = $('#navigation'+step_name).parent().width();

		navigation_pos = (navigation_parent_width/2) - ((next_step_btn_width/2)+5);

		$('#navigation'+step_name).css({'marginLeft' : navigation_pos+5});

		update_progress(1);

		focus_inupt(0);

		//Add from back btn

		$('#steps'+step_name+' #back_btn').hide();
	}

	function move_to_next_question(){
		back_action=false;				
		execute_event($(this).index());
		$('#steps'+step_name+' #back_btn').show();
	}

	$(document).on( "click", "#navigation_series li,#navigation_fitting li,#navigation_driver li,#navigation_led li,#navigation_fixture li,#navigation_upload li", function() {
  		back_action=false;				
		execute_event($(this).index());
		$('#steps'+step_name+' #back_btn').show();
	});
	//end events

	$(document).on( "click", "#select_and_go_next_step", function() {
  		form_ready();
	});

	//Enter keybard press event
	$(document).on('keypress', function(e){
		var keyCode = e.keyCode || e.which
		if(keyCode === 13) {
			var current_step_idx = $('#navigation'+step_name+' li.current_nav').index();
			back_action=false;
			execute_event(current_step_idx);
			$('#steps'+step_name+' #back_btn').show();
		}
	});

	$(document).on('click', '#steps_series #back_btn,#steps_fitting #back_btn,#steps_driver #back_btn,#steps_led #back_btn,#steps_fixture #back_btn,#steps_upload #back_btn' ,function(e){
		back_action=true;
			
		var current_step_idx = $('#navigation'+step_name+' li.current_nav').index();	
		
		go_to_previese_question(current_step_idx);
		if($('#navigation'+step_name+' li.current_nav').index() ==1)
				$('#steps'+step_name+' #back_btn').hide();
			else
				$('#steps'+step_name+' #back_btn').show();

	});	    
	
	function go_to_previese_question(idx){
		if((!clickable_btn || !$('#navigation'+step_name+' li').eq(idx).hasClass('current_nav')) &&
			!($('.current_nav').attr('id') >= idx)){
			return false;
		}
		if(idx<list_elem_count-1)
			if(back_action)
				navigation_pos =  navigation_pos+20;
		animate_navigation(idx-1, navigation_pos);
		remove_data_row();
	}
	
	//Function to start the animation
	function execute_event(idx){
		if((!clickable_btn || !$('#navigation'+step_name+' li').eq(idx).hasClass('current_nav')) &&
			!($('.current_nav').attr('id') >= idx)){
			return false;
		}

		if(!validate_form(idx)){
			show_error(idx);
			return false;
		}else{
			clickable_btn = false;
			clear_error();

			if(idx<list_elem_count-1){
				navigation_pos =  navigation_pos-20;
			}
			animate_navigation(idx+1, navigation_pos);
			add_data_row();
			
		}
	}
	
	function add_data_row(){ 
		var qustion=$("#"+step_name+" .current_step p").text();
		var answer="";
		var details_question="";
		var details_answer="";
		var newRowContent="";
		var detailsContent="";
		//main question
		var answerSelectedLength=$("#"+step_name+" .current_step .question-main select").find(":selected").length;
		if(answerSelectedLength>0){
			//main multi select or one select
			var comma=' , ';
			for (var i = 0 ; i < answerSelectedLength; i++) {
				if(i==answerSelectedLength-1)
					comma='';
				answer+= $("#"+step_name+" .current_step .question-main select").find(":selected").eq(i).text()+comma;	
			}
			
		}
		else//main on
			answer=$("#"+step_name+" .current_step .question-main input").val();
		if(answer==undefined)
			answer="\n";
		//details question
		if($('#'+step_name+' li.current_step div').hasClass("question-details"))
		{
			if($('#'+step_name+' li.current_step .question-details').css('display').toLowerCase()=="grid")
			{
				//var control_count=$('#'+step_name+' li.current_step .question-details').children().length;
				var control_count=$('#'+step_name+' li.current_step .details-row').length;
				for (var i = 0; i < control_count; i++) {
					
					var elem=$('#'+step_name+' li.current_step div.details-row').eq(i);
					//parent none hide
					if(elem.parent().css('display').toLowerCase()=="grid")
					{
						//question value
						details_question=$('#'+step_name+' li.current_step .question-details .details-row:eq('+i+') label').text();

						//answer
						details_answer=$('#'+step_name+' li.current_step .question-details .details-row:eq('+i+') select').val();
						if(details_answer != undefined)
							details_answer=$('#'+step_name+' li.current_step .question-details .details-row:eq('+i+') select').find(":selected").text();
							
						else{
							details_answer=$('#'+step_name+' li.current_step .question-details .details-row:eq('+i+') textarea').val();
							if(details_answer==undefined)
								details_answer=$('#'+step_name+' li.current_step .question-details .details-row:eq('+i+') input').val();

						}
						//detailsContent+="<tr><td>"+details_question+"</td><td>"+details_answer+"</td></tr>";
						//detailsContent+=details_question+" : "+details_answer+"<br/>";
						//not sutable detailsContent+="<td>"+details_question+"</td><td>"+details_answer+"</td>";
						detailsContent+="<tr><td>"+details_question+"</td><td>"+details_answer+"</td></tr>";
					}
										
					}
					detailsContent="<table style='width: 100%;'>"+detailsContent+"</table>";
			}
		}

		newRowContent="<tr><td>"+qustion+"</td><td>"+answer+detailsContent+"</td></tr>";
		$("#table"+step_name+" tbody.main-table").append(newRowContent);
	}

	function remove_data_row(){
		$("#table"+step_name+" tr:last-child").remove();
	}

	//Function to animate the clicked button  & the SVG icon
	function animate_navigation(btn_index, new_pos){
		var s = Snap('#navigation'+step_name+' .current_nav .arrow');
		if(back_action)	
			$('#navigation'+step_name+' li').eq(btn_index+1).addClass('animate');
		else
			$('#navigation'+step_name+' li').eq(btn_index-1).addClass('animate');

		s.stop().animate({'points' : svg_valid_icon}, 150, mina.easeout, function(){			
			if(btn_index<list_elem_count){
				$("#navigation"+step_name+" .arrow").velocity("fadeOut", {delay : 200, duration: 200, complete : function(){
					update_nav_position(btn_index, new_pos);
					$(this).eq(btn_index).css({"opacity" : 1});
					clickable_btn = true;
				}});

			}else if(btn_index==list_elem_count){
				
				update_nav_position(btn_index, new_pos);
				form_ready();

			}			
		});		
	}


	//Update the navigation position
	function update_nav_position(el_index, new_pos){
		$('#navigation'+step_name).velocity({marginLeft : new_pos}, 200);
		$('#navigation'+step_name+' li').eq(el_index).addClass('current_nav').siblings().removeClass('current_nav animate');

		if(back_action)
			$('#navigation'+step_name+' li').eq(el_index+1).addClass('valid');
		else
			$('#navigation'+step_name+' li').eq(el_index-1).addClass('valid');

		if(el_index <= list_elem_count-1){
			$('#navigation'+step_name+' list_elem_count').eq(list_elem_count-1).addClass('submit');
			//$('#navigation'+step_name+' list_elem_count').eq(list_elem_count-1).attr('name', 'submit' + step_name);
			if(back_action)
				previous_step(el_index);
			else
				next_step(el_index);

			focus_inupt(el_index);
		}
		else if(el_index == list_elem_count){
			/*$("#"+step_name).submit(function(){
				//ajax call
				$.ajax({
					url: "http://localhost:8082/rafeed/index.php/Product/test",
					type: "POST",
					cache: false,    
					data: $('#'+step_name).serialize(),
					success: function(json){      
					  try{  
						   var obj = jQuery.parseJSON(json);
						   alert(obj);
						      }
				      catch(e) {  
					   alert('Exception while request..');
					  }  
					  },
					  error: function(){      
					   alert('Error while request..');
					  }
					 });
				});
			   */
			//$("#"+step_name).submit();
		}
	}

	 $('#'+step_name).bind('submit', function () {
          $.ajax({
            type: 'post',
            url: "http://localhost:8082/rafeed/index.php/Product/test",
            data: $('#'+step_name).serialize(),
            success: function () {
              alert('form was submitted');
            }
          });
          return false;
        });

	function question_details_validate(){
		var empty=false;
		for (var i = 0; i < $('#'+step_name+' li.current_step div.question-details').children().length; i++) {
			if($('#'+step_name+' li.current_step div.question-details').children().eq(i).hasClass('required'))
			{
				var elem=$('#'+step_name+' li.current_step div.question-details').children().eq(i);
				//parent none hide
				if(elem.parent().css('display').toLowerCase()=="grid")
					if(elem.find('select').val() =='')
						empty= true;
					else 
						if(elem.find('select').val() ==undefined)
							if(elem.find('input').val()=='')
								empty= true;

				
			}
		}
		return !empty;
	}

	//Function to validte the form
	function validate_form(step_index){
		var validate=true;
		//var val=$('#steps'+step_name+' li input').eq(step_index).val();
		if($('#'+step_name+' li.current_step div').hasClass('question-main')){
			if($('#'+step_name+' li.current_step .question-main span').hasClass('text-danger')){
				var val=$('#'+step_name+' li.current_step .question-main input.required').val();
					/*if(val==undefined)
						val=$('#'+step_name+' li.current_step input.dimentionValue').val();*/
					if(val==undefined)
						val=$('#'+step_name+' li.current_step select.text_field').find(":selected").text();
					if(val == ''){
						validate= false;
					}
			}
		}
		if(validate==true && $('#'+step_name+' li.current_step div').hasClass('question-details'))
		{
			for (var i = 0; i < $('#'+step_name+' li.current_step .question-details').length; i++) {
				if($('#'+step_name+' li.current_step .question-details').eq(i).css('display').toLowerCase()=="grid")
					{
						validate= question_details_validate();
					}
				}
		}
		return validate;
	}
		

	//Function to focus on the form inputs
	function focus_inupt(input_idx){
		if($('#steps'+step_name+' li input').length != 0){
			$('#steps'+step_name+' li input').eq(input_idx).focus();
		}else{
			return false;
		}
	}


	//Function to add navigation
	function add_navigation(){
		if(list_elem_count==0){
			return false;
		}

		var pag_markup = '<div class="navigation_container"><ul class="clearfix" id="navigation'+step_name+'">';
		var icon_markup = '<div class="icon-arrow" id="icon_wrapper"><svg x="0px" y="0px" width="24.3px" height="23.2px" viewBox="0 0 24.3 23.2" enable-background="new 0 0 24.3 23.2" xml:space="preserve"><polygon class="arrow" fill="#ffffff" points="'+ svg_arrow_icon +'"></svg></div>';
		
		for (var i = 1; i <= list_elem_count; i++) {
			pag_markup = pag_markup + '<li>'+ icon_markup + '</li>';
		};
		
		$('#steps'+step_name).after(pag_markup + '</div>');		
		$('#navigation'+step_name+' li').eq(0).addClass('current_nav');
	}


	//Function to show the next step
	function next_step(idx){
		$('#steps'+step_name+' li.form-group').eq(idx-1).removeClass('current_step');
		$('#steps'+step_name+' li.form-group').eq(idx).addClass('current_step');
		update_progress(idx+1);
	}

	function previous_step(idx){
		$('#steps'+step_name+' li.form-group').eq(idx+1).removeClass('current_step');
		$('#steps'+step_name+' li.form-group').eq(idx).addClass('current_step');
		update_progress(idx);
	}

	//Function to show errors on the form & navigation
	function show_error(index){
		$('#navigation'+step_name+' li').eq(index).addClass('error animate');
		$('#steps'+step_name+' li').eq(index).addClass('error');
	}


	//Function to clear the errors on the form & navigation
	function clear_error(){
		$('#navigation'+step_name+' li').removeClass('error');
		$('#steps'+step_name+' li').removeClass('error');
	}


	//Function to send the form or show a message
	function form_ready(){
		//go to next step
		//alert('Thanks for filling up the form!');
		next_step_progress();
		go_to_next_form();
		if(step_name=="_fixture"){
			calcFixtureIP();
			calcFixtureIK();
			calcFixtureLifeSpan();
			calcFixtureWarranty();
		}
		else
			if(step_name=="_review")
				reviewAllDataProduct();
		list_elem_count = $("#steps"+step_name+" li.form-group").length;
		clickable_btn = true;
		initForm();
	}

	$("#go_to_step_series").on('click', function(e){
		go_to_step('_series');
	});
	
	function go_to_step(s_name){
		step_name=s_name;
		list_elem_count = $("#steps"+step_name+" li.form-group").length;
		clickable_btn = true;
		initForm();	
	}

	function go_to_next_form(){
		switch(step_name) {
			case "_series":
        		step_name="_fitting";
        		break;
    		case "_fitting":
        		step_name="_driver";
        		break;
    		case "_driver":
        		step_name="_led";
        		break;
    		case "_led":
        		step_name="_fixture";
        		break;
    		case "_fixture":
        		step_name="_upload";
        		break;
			case "_upload":
        		step_name="_review";
        		break;
			}
	}

	function go_to_preveos_form(){
		switch(step_name) {
			case "_series":
        		step_name="_fitting";
        		break;
    		case "_fitting":
        		step_name="_driver";
        		break;
    		case "_driver":
        		step_name="_led";
        		break;
    		case "_led":
        		step_name="_fixture";
        		break;
    		case "_fixture":
        		step_name="_upload";
        		break;
			case "_upload":
        		step_name="_review";
        		break;
			}
	}
	//Function to update step number(visible on small size screens)
	function update_progress(idx){
		$('.step_nb').text(idx +'/'+list_elem_count);
	}


});