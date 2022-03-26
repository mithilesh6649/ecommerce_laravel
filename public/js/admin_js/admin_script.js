
$(document).ready(function(){
   
    //Check Admin password is correct or not

    $("#current_pwd").on('input',function(){
        var current_pwd = $(this).val();
     
         $.ajax({
              type:"POST",
              url:'/admin/check-current-pwd',
              data:{
                _token: $('body').attr('token'),  
                current_pwd:current_pwd,
              },
              success:function(response){
                 console.log(response);
              },
              error:function(error,xhr,response){
                alert(response);
              }
         });


    });
  


});