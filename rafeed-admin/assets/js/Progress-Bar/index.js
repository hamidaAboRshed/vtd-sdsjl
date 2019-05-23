var i = 1;
$('.step_progress .circle').removeClass().addClass('circle');
$('.step_progress .step_bar').removeClass().addClass('step_bar');
$('.step_progress .circle:nth-of-type(' + i + ')').addClass('active');

//hide all panel

$('#row_2').addClass('hide');
$('#row_3').addClass('hide');
$('#row_4').addClass('hide');
$('#row_5').addClass('hide');
$('#row_6').addClass('hide');
$('#row_7').addClass('hide');


function next_step_progress(){
  i++;

  $('.step_progress .circle:nth-of-type(' + i + ')').addClass('active');
  
  $('.step_progress .circle:nth-of-type(' + (i-1) + ')').removeClass('active').addClass('done');
  
  $('.step_progress .circle:nth-of-type(' + (i-1) + ') .label').html('&#10003;');

  $('.step_progress .step_bar:nth-of-type(' + (i-1) + ')').addClass('active');
  
  $('.step_progress .step_bar:nth-of-type(' + (i-2) + ')').removeClass('active').addClass('done');

  $('#row_'+i).removeClass('hide');

  $('#row_'+(i-1)).addClass('hide');
  
  
}

function previous_step(){
  
if(i!=1){
  $('.step_progress .circle:nth-of-type(' + i + ') .label').html( i );

  $('.step_progress .circle:nth-of-type(' + i + ')').removeClass().addClass('circle');
  
  $('.step_progress .circle:nth-of-type(' + (i-1) + ') .label').html( i-1 );

  $('.step_progress .circle:nth-of-type(' + (i-1) + ')').removeClass('done').addClass('active');

  $('.step_progress .step_bar:nth-of-type(' + (i-1) + ')').removeClass('active');
  
  $('.step_progress .step_bar:nth-of-type(' + (i-2) + ')').removeClass('done').addClass('active');

  $('#row_'+i).addClass('hide');

  $('#row_'+(i-1)).removeClass('hide');

  i--;
}
}

function start_progress(){
  $('.step_progress .step_bar').removeClass().addClass('step_bar');
  $('.step_progress div.circle').removeClass().addClass('circle');

}

/*$( "#ProgressPanel" ).load(function() {
  start_progress();

});*/

