
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

//02 - Section Active and Inactive status............

$(document).ready(function(){
  $('.updateSectionStatus').click(function(){
    var status = $(this).text();
    var section_id = $(this).attr('section_id');
    var usr = window.hostname;
    
    $.ajax({
         type:"post",
         url:'/admin/update-section-status',
         data:{
           status:status,
           section_id:section_id,
           _token:$('body').attr('token'),
         },
         beforeSend:function(){
          $("#section-"+section_id).html('<font color="yellow">Processing.....</font>');
          $("#section-"+section_id).css("pointer-events", "none");
         },
         success:function(response){
          console.log(response);
         // alert(response['section_id']);
         // alert(response['status']);

        // console.log($("#section-"+response['section_id']).html());
        $("#section-"+section_id).css("pointer-events", "auto");
        if(response['status'] == 0)
         {
          $("#section-"+response['section_id']).html('<font color="red">Inactive</font>');
         }
         else{
          $("#section-"+response['section_id']).html('<font color="green">Active</font>');
         }

         },
         error:function(){
          alert('Error');
         }
    });


  });
});