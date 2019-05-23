$(document).ready(function(){

    $('#gallery').simplegallery({
        galltime : 400,
        gallcontent: '.content',
        gallthumbnail: '.thumbnail',
        gallthumb: '.thumb'
    });

    $('#product_dimension_table .clickable-row')[0].click();

    $(".dim_row").click(function(){
        $('html, body').animate({
            scrollTop: $('#product_spec').offset().top
        }, 'slow');
    });

});

$('#product_dimension_table').on('click', '.clickable-row', function(event) {
	$(this).addClass('active').siblings().removeClass('active');
	var dim="dim_"+this.id;
	$('#product_option tr').each(function () {
		if (this.id != "header") {
			if (this.id != dim )
				$(this).addClass('hide');
			else
				$(this).removeClass('hide');
		}
		
	});
	$('.filter-panel div').each(function () {
		if (this.id !="") {
			if (this.id != dim )
			$(this).addClass('hide');
		else
			$(this).removeClass('hide');
		}
	
	});

	$('.filter-panel #'+dim+' input')[0].click();
	$('.thumbnail').each(function () {
		if (this.id != dim) 
		$(this).addClass('hide');
	else
		$(this).removeClass('hide');
	});
	$('#gallery .content').each(function () {
		if (this.id != dim) 
		$(this).addClass('hide');
	else
		$(this).removeClass('hide');
	});
	$('.thumbnail#'+dim+' a')[0].click();
});

function power_filter(elm,dim) {
	var power= $('label[for="'+elm.id+'"]').html();
	//power = power.slice(0,-5);
	power=power.replace(/\D/g,'');
	$('#product_option tbody tr').each(function(){
		t_power=$(this).find('#power').html();
		t_power=t_power.replace(/\D/g,'');
		if(t_power == power && this.id == dim)
			$(this).removeClass('hide');
		else
			$(this).addClass('hide');
	});
}