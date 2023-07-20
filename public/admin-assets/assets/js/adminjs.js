$(function () {
    // $(".table").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('.table').DataTable({
      "paging": true,
      //"lengthChange": false,
      // "searching": false,
      "ordering": true,
      "info": true,
      //"autoWidth": false,
      "responsive": true,
    });
  });

///////Show toastr messages////////
$(".admin-toastr").trigger('click');
function toastr_success(msg) {
    toastr.success(msg)
}
function toastr_danger(msg) {
    toastr.error(msg)
}
///////Show toastr messages////////



///////////Summer Notes//////////////
$(function () {
    // Summernote
    $('#content').summernote({height: 100});
    $('#content'). summernote('reset');
    
});
//////Summernote Validation on form Submittion////////////
$( "#add_new_blog_form" ).submit(function( event ) { 
        
    $('#content-summernote-error').remove();
    $('.note-editable.card-block').css('border', '');

    if($("#content").summernote("isEmpty") == true){ //alert('sdfsdf');
        
        $('<span id="content-summernote-error" class="content-summernote-error">Please Enter Description</span>').insertAfter(".note-editor");
        $('.note-editable.card-block').css('border','1px solid red');
        return false;      

    } 
});


//////////Form Validations///////////
$(function () {

    $("#add_new_user_form").validate({
        
        rules: {
                firstname: {
                    required: true,
                    // minlength: 5         
                },
                lastname:{
                    required: true, 
                },
                email:{
                    required: true,
                    email: true,  
                    //email_custom_rule : true,   
                    email_custom_rule: {
                         //Apply validation only in "Add New Users" not in "Edit User Form"   
                        depends: function(elem) {   
                            var fomrs_id = $(this).parents("form").attr("id");                   
                            return fomrs_id != 'users_editform';
                        } 
                    }           
                },
                country :{
                    required: true,
                },          
                user_status :{
                    required: true,
                },
                password :{
                    //required: true,
                     required: {
                        //Apply Validation only in "Add new Subadmin From" not in "Edit Subadmin Form"
                        depends: function(elem) {   
                            var fomrs_id = $(this).parents("form").attr("id");                   
                            return fomrs_id != 'users_editform';
                        } 
                    }
                }

        },
        messages: {
            firstname: {
              required: "Please enter first name",
            },
            lastname: {
              required: "Please enter last name",
            },
            email:{
                required: "Please enter Email",
            },
            country:{
                required: "Please select country",
            },          
            user_status :{
                required: "Please select at least one",
            },
            password : {
                required: "Please enter user password",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });

    $('#add_new_subadmin_form').validate({
        
        rules: {
          email: {
            required: true,
            email: true,
            //subadmin_email_rule: true
            subadmin_email_rule: {
                 //Apply validation only in "Add new Subadmin" not in "Edit Subadmin Form"   
                depends: function(elem) {   
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            }

          },
          password: {            
            minlength: 5,
            //required: true,
            required: {
                //Apply Validation only in "Add new Subadmin From" not in "Edit Subadmin Form"
                depends: function(elem) {   
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            } 

          },
          username: {
            required: true,
            minlength: 5,
            maxlength: 15,            
            //subadmin_username_rule: true
            subadmin_username_rule: {
                depends: function(elem) {        
                    //Apply validation only on Add new Subadmin            
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            }

          },
          phoneNumber: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
            },
            subadmin_status: {
              required :true
            },
        },
        

        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          username: {
            required: "Please enter a username",
            minlength: "Your username must be at least 5 characters long",
            maxlength: "Your username should not exceed 15 characters.",
          },
          phoneNumber: {
            required: "Please enter phone number",
          //    minlength: "Your phone number must be at least 10 digit long",
          //   maxlength: "Your username should not exceed 15 characters.",
          },
            subadmin_status: {
                required: "Please choose status",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });

    $("#add_new_blog_form").validate({

        rules: {
            title: {
                required: true,                        
            },
            content:{
                required: true, 
            },
            blog_icon:{   
                required: {
                    depends: function(elem) {                    
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'blog_editform';
                    } 
                }      
            },           
            blog_status :{
                required: true,
            }            

        },
        messages: {
            title: {
                required: "Please Enter Title",
            },
            content: {
                required: "Please Enter content",
            },
            blog_icon: {
                required: "Please Choose Blog image",   
            },
            blog_status:{
                required: "Please Select Status",
            }            
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

    });

    var res;
    $.validator.addMethod('email_custom_rule', function(value,element){ 
        var urlss = base_url +'admin/check-email-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uemail', useremail: value, _token: csrf_token},
            //dataType: "html",
            async: false,  
            success:function(response) {  //alert(response); 
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }                
            }            
        }); 
        return res;    
    },'Email is already taken.');    
    $.validator.addMethod('subadmin_username_rule', function(value,element){
        var urlss = base_url +'admin/check-subadminuser-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uname', username: value, _token: csrf_token},
            //dataType: "html",  
            async: false,
            success:function(response) {   
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }
                //res = (response !== 'true') ? false : true;
            }            
        }); 
        return res;    
    },'Username is already taken.');
    $.validator.addMethod('subadmin_email_rule', function(value,element){
        var urlss = base_url +'admin/check-subadminuser-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uemail', useremail: value, _token: csrf_token},
            //dataType: "html",
            async: false,  
            success:function(response) {   
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }
                //res = (response !== 'true') ? false : true;
            }            
        }); 
        return res;    
    },'Email is already taken.'); 
    
});






//////Resest errors and reset from when close////////
$('.modal').on('hidden.bs.modal', function() {

    ////Users Listing form
    if($(this).find('form').attr("id") == 'add_new_user_form' || $(this).find('form').attr("id") == 'users_editform'){

        $(this).find('form').attr("id","add_new_user_form");  
        //$(this).find('form').attr("name","add_new_user_form");
        $(this).find('form').attr("action",base_url+'admin/insert-users');
        $('.email').attr('readonly', false);
        $("#modal-default .modal-header .modal-title").html('Add User');
        $('.hidden_user_id').remove();

        var $userform = $('#add_new_user_form');
        $userform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $userform.find('.error').removeClass('error');
        $userform.find('.is-invalid').removeClass('is-invalid'); 

    } else if($(this).find('form').attr("id") == 'add_new_subadmin_form' || $(this).find('form').attr("id") == 'subadmin_editform'){

        $(this).find('form').attr("id","add_new_subadmin_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-subadmin');
        $("#modal-subadmin .modal-header .modal-title").html('Add Subadmin');
        $('.hidden_input_catid').remove();

        var $subadminform = $('#add_new_subadmin_form');
        $subadminform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $subadminform.find('.error').removeClass('error');
        $subadminform.find('.is-invalid').removeClass('is-invalid'); 

    } else if($(this).find('form').attr("id") == 'add_new_blog_form' || $(this).find('form').attr("id") == 'blog_editform'){

        $(this).find('form').attr("id","add_new_blog_form");  
        $(this).find('form').attr("action",base_url+'admin/create-blog');
        $("#modal-default .modal-header .modal-title").html('Add Blog');
        $('.hidden_input_catid').remove();

        var $blogform = $('#add_new_blog_form');
        $blogform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $blogform.find('.error').removeClass('error');
        $blogform.find('.is-invalid').removeClass('is-invalid'); 

    }

});

//////Open popup for Edit Users ///////////
$("body").on("click", ".admin_edit_users", function (e) {

    e.preventDefault();
    var userid = $(this).attr('user_id');            //alert(userid);
    var first_name = $(this).attr('first_name');        //alert(first_name);
    var last_name = $(this).attr('last_name');
    var email = $(this).attr('email');      //alert(useremail);
    var country = $(this).attr('country');      //alert(country);
    var user_status = $(this).attr('user_status');      //alert(userstatus); 

    $('.modal').modal('show');
    //Change From_id and Form_Action    
    $('#modal-default').find('form').attr("id","users_editform");  
    //$('#modal-default').find('form').attr("name","users_editform");
    $('#modal-default').find('form').attr("action",base_url+'admin/edit-users');  

    $("#modal-default .modal-header .modal-title").html('Edit User');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_user_id" value='+userid+' class="hidden_user_id">';
    $(".firstname").after(input_hidden);

    $('.firstname').val(first_name);
    $('.lastname').val(last_name);
    $('.email').val(email);
    $('.country').val(country);
    $('.email').attr('readonly', true);
    if (user_status == 'active'){
        $('.user_status_active').prop('checked', true);
    } else {
        $('.user_status_inactive').prop('checked', true);
    }

});

//////Open popup for Edit SubAdmin ///////////
$("body").on("click", ".admin_edit_subadmin", function (e) {

    e.preventDefault();
    var userid = $(this).attr('userid');            //alert(userid);
    var username = $(this).attr('username');        //alert(username);
    var useremail = $(this).attr('useremail');      //alert(useremail);
    var userphone = $(this).attr('userphone');      //alert(userphone);
    var userstatus = $(this).attr('userstatus');      //alert(userstatus); 

    $('.modal').modal('show');
    //Change From_id and Form_Action
    //var originurl   = window.location.origin;
    $('#modal-subadmin').find('form').attr("id","subadmin_editform");  
    $('#modal-subadmin').find('form').attr("action",base_url+'admin/edit-subadmin');  

    $("#modal-subadmin .modal-header .modal-title").html('Edit Subadmin');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_subadmin_id" value='+userid+' class="hidden_subadmin_id">';
    $(".subadmin_name").after(input_hidden);

    $('.subadmin_name').val(username);
    $('.subadmin_email').val(useremail);
    $('.subadmin_mobile').val(userphone);
    if (userstatus == 'active'){
        $('.subadmin_status_active').prop('checked', true);
    } else {
        $('.subadmin_status_inactive').prop('checked', true);
    }  

});

//////////Open popup for Edit Blog////////////
$("body").on("click", ".admin_edit_blog", function (e) {

    e.preventDefault();
    var blog_id = $(this).attr('blog_id');            //alert(blog_id);
    var blog_title = $(this).attr('blog_title');      //alert(blog_title);
    var blog_content = $(this).attr('blog_content');        //alert(useremail);
    var blog_icon_path = $(this).attr('blog_icon_path');
    var blog_image = $(this).attr('blog_icon');        //alert(userphone);
    var blogstatus = $(this).attr('blog_status');      //alert(blogstatus); 

    $('.modal_blog').modal('show');
    //Change From_id and Form_Action    
    $('#modal-default').find('form').attr("id","blog_editform");  
    $('#modal-default').find('form').attr("action",base_url+'admin/edit-blog');  
    //$('#modal-default').find('form').find('content').attr("action",base_url+'admin/edit-blog');

    $("#modal-default .modal-header .modal-title").html('Edit Blog');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_blog_id" value='+blog_id+' class="hidden_blog_id">';
    $(".title").after(input_hidden);

    $('.title').val(blog_title); 
    
    $('#content').summernote({
        height: 100
    }).summernote('code', blog_content);


    if (blogstatus == 'active'){
        $('.blog_status_active').prop('checked', true);
    } else {
        $('.blog_status_inactive').prop('checked', true);
    }  

    $('.show_cat_icon').attr('src',blog_icon_path+'/'+blog_image);

});



/////////Delete Confirmation///////////
$('.show_confirm').click(function(event) {
  var form =  $(this).closest("form");
  var name = $(this).data("name");
  event.preventDefault();
  swal({
      title: `Are you sure you want to delete this record?`,
      text: "If you delete this, it will be gone forever.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      form.submit();
    }
  });
});

////////Show image befoe upload//////////
$('.cat-file-input').change(function(){
    var curElement = $('.show_cat_icon');
    // console.log(curElement);
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        curElement.attr('src', e.target.result);
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});