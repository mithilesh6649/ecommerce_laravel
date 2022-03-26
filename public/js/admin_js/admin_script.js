
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
              beforeSend:function(){
                $(".password-notice").html("<i class='text-warning font-weight-bold '>Please wait checking ...</i>"); 
                $(".pwd_submit_btn").attr('disabled','disabled');
              },    
              success:function(response){
                $(".password-notice").html(" ");
                 //console.log(response);
                // $(".password-notice").html("hello i am here");
                if(response.trim() == 'success'){
                    $(".password-notice").html("<i class='text-success font-weight-bold '> Current Password Is Correct</i>");
                    $(".pwd_submit_btn").removeAttr('disabled');
                }
                else{
                    $(".password-notice").html("<i class='text-danger font-weight-bold '> Current Password Is Incorrect</i>");
                }
              },
              error:function(error,xhr,response){
                console.log(response);
               // $(".password-notice").html("Who are you");
              }
         });


    });
  


});