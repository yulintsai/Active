       //狀態更新
    
    
    $(document).ready(function(){
            
       function ShowOnlinePlayers(){
              $.ajax({url:'/Active/Event/show',type:'POST',async: true,success:function(data){$('#Event_box').html(data);}});
              var t=setTimeout(ShowOnlinePlayers,3000);
          };      
              ShowOnlinePlayers();
              
               /*------------------------登出事件--------------------------*/      
      $('#logout').click(function() { //登出事件
      
      
           if(confirm("Are You Sure to Logout?"))
            {  
           document.location.href="/Active/Login/logout";
            
            }
            else
            {
            //alert("你按下取消");
            }
       })      
    
        //$('#eventStarttime,#eventEndtime').val(new Date().toDateInputValue());
              
       // $('#tst').click(function(){
       // document.location.href="/Active/Event/show";
       // });
    });