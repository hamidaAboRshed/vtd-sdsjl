
//document.querySelector('.sweet-prompt').onclick = function(){
/*
 $.ajax({
                type: "POST",
                url: "../BUS/WebService.asmx/LIST_BU",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    $("#cb_info").html('');
                    $.each($.parseJSON(data.d), function (idx, obj) {
                    //$.each(data, function (idx, obj) {
                        $("#cb_info").append('<option value="' + obj.BU_ID + '">' + obj.BU_NAME + '</option>');
                    });
                    $("#cb_info").trigger("liszt:updated");
                    $("#cb_info").chosen({ width: "95%" });
                },
                error: function (data) {
                    console.log(data.d);
                }
            }); 
*/
/*function updata_datasource(){
    var url = "../BUS/WebService.asmx/LIST_BU";
    $.getJSON(url, function(json){
        var $select_elem = $("#cb_info");
        $select_elem.empty();
        $.each(json, function (idx, obj) {
            $select_elem.append('<option value="' + obj.BU_ID + '">' + obj.BU_NAME + '</option>');
        });
    $select_elem.chosen({ width: "95%" });
})
}

$.each(json, function () {
   $.each(this, function (name, value) {
      console.log(name + '=' + value);
   });
});
*/


/*
$.ajax({
                type: 'post',
                async: false,
                url: '../indexes/Indexes/is_exist',
                data: {'index_name':index_type,
                        'index_value':this.swalForm.NameVal,
                        'Language_Ids':this.swalForm.Language_Id},
                 success: function(result){ 
                     if(result>0){
                        swal.showInputError('This value is exist.')
                        return false;
                     }
                     else{
                         $.ajax({
                             type: 'post',
                             async: false,
                             url: '../indexes/Indexes/set_value',
                             data: {"index_name":index_type,"index_value":this.swalForm},
                             success: function(data){
                             swal("Hey !!", "You add: " + this.swalForm, "success");
                                }
                            });
     
                        }
                    }
                });
*/
    /*swal({
            title: "Index",
            //text: '<form role="form" id="contact-form" method="post"><div class="control-group"><label for="friend_name">Your friend\'s name</label><input type="text" placeholder="Your friend\'s full name" id="friend_name" name="friend_name" required></div><div class="control-group"><label for="email">Email</label><input type="email" placeholder="Your friend\'s Email" id="email" name="email" required></div></form>',
            //html: true,
            text: "Add new value",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function(inputValue){
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            $.ajax({
                type: 'post',
                url: '../indexes/Indexes/get_value_by_name',
                data: {'index_name':'product_series',
                        'index_value':inputValue},
                 success: function(result){ 
                     if(result>0){
                        swal.showInputError('This value is exist.')
                        return false;
                     }
                     else{
                         $.ajax({
                             type: 'post',
                             url: '../indexes/Indexes/set_value',
                             data: {"index_name":"product_series","index_value":inputValue},
                             success: function(data){
                             //resolve()
                             //alert("added");
                             swal("Hey !!", "You add: " + inputValue, "success");
                            }
                            });
     
                        }
                    }
                });
                //swal("Hey, your ajax request finished !!");
            }
        
    );*/
//};
     /*swal({
        title: 'Add new value',
        type: "input",
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
        closeOnConfirm:false,
        preConfirm: function (index_value) {
            return new Promise(function (resolve, reject) {
                setTimeout(function() { 
                     $.ajax({
                     type: 'post',
                     url: 'http://localhost:8082/rafeed/index.php/Indexes/get_value_by_name',
                     data: {index_name:'product_series',
                            index_value:index_value},
                     success: function(result){
                         if(result>0){
                            reject('This value is exist.')
                         }
                         else{
                             $.ajax({
                                 type: 'post',
                                 url: 'http://localhost:8082/rafeed/index.php/Indexes/set_value',
                                 data: {index_name:'product_series',
                                        index_value:index_value},
                                 success: function(data){
                                 resolve()
                                }
                            });
         
                            }
                        }
                    });
     
                }, 10000)
            })
        },
         allowOutsideClick: true
         },function(inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            $.ajax({
                     type: 'GET',
                     url: 'http://localhost:8082/rafeed/index.php/indexes/Indexes/get_value_by_name',
                     data: {'index_name':'product_series',
                            'index_value':inputValue},
                    contentType: 'application/json; charset=utf-8',
                     success: function(result){
                         if(result>0){
                            reject('This value is exist.')
                         }
                         else{
                             $.ajax({
                                 type: 'post',
                                 url: 'http://localhost:8082/rafeed/index.php/indexes/Indexes/set_value',
                                 data: {"index_name":"product_series",
                                        "index_value":inputValue},
                                 success: function(data){
                                 resolve()
                                }
                            });
         
                            }
                        }
                    });
            swal("Hey !!", "You add: " + inputValue, "success");
        });
*/
//};




/*document.querySelector('.sweet-wrong').onclick = function(){
    sweetAlert("Oops...", "Something went wrong !!", "error");
};
document.querySelector('.sweet-message').onclick = function(){
    swal("Hey, Here's a message !!")
};
document.querySelector('.sweet-text').onclick = function(){
    swal("Hey, Here's a message !!", "It's pretty, isn't it?")
};
document.querySelector('.sweet-success').onclick = function(){
    swal("Hey, Good job !!", "You clicked the button !!", "success")
};
document.querySelector('.sweet-confirm').onclick = function(){
    swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: false
        },
        function(){
            swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
        });
};
document.querySelector('.sweet-success-cancel').onclick = function(){
    swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this imaginary file !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            cancelButtonText: "No, cancel it !!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success");
            }
            else {
                swal("Cancelled !!", "Hey, your imaginary file is safe !!", "error");
            }
        });
};
document.querySelector('.sweet-image-message').onclick = function(){
    swal({
        title: "Sweet !!",
        text: "Hey, Here's a custom image !!",
        imageUrl: "images/hand.jpg"
    });
};
document.querySelector('.sweet-html').onclick = function(){
    swal({
        title: "Sweet !!",
        text: "<span style='color:#ff0000'>Hey, you are using HTML !!<span>",
        html: true
    });
};
document.querySelector('.sweet-auto').onclick = function(){
    swal({
        title: "Sweet auto close alert !!",
        text: "Hey, i will close in 2 seconds !!",
        timer: 2000,
        showConfirmButton: false
    });
};*/
/*document.querySelector('.sweet-prompt').onclick = function(){
    swal({
            title: "Enter an input !!",
            text: "Write something interesting !!",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        },
        function(inputValue){
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            swal("Hey !!", "You wrote: " + inputValue, "success");
        });
};*/
/*document.querySelector('.sweet-ajax').onclick = function(){
    swal({
            title: "Sweet ajax request !!",
            text: "Submit to run ajax request !!",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function(){
            setTimeout(function(){
                swal("Hey, your ajax request finished !!");
            }, 2000);
        });
};
*/