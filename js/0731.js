       //狀態更新
    
    
    $(document).ready(function(){
            $.ajax({url:'/Active/Event/show',type:'POST',success:function(data){$('#Event_box').html(data);}});
    //   function ShowOnlinePlayers(){
    //           $.ajax({url:'/Active/Event/show',type:'POST',success:function(data){$('#Event_box').html(data);}});
    //           var t=setTimeout(ShowOnlinePlayers,10000);
    //       };      
    //           ShowOnlinePlayers();
              
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
   
       $('.dt').datetimebox({
          formatter:function(date){
              var y=date.getFullYear();
              var m=date.getMonth()+1;
              var d=date.getDate();
              var H=date.getHours();
              var min=date.getMinutes();
              return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d)+' '+H+':'+min+':00';        
              },
            parser:function(s){
              var t=Date.parse(s);
              if (!isNaN(t)) {return new Date(t);}
              else {return new Date();}
              }      
       });
    });