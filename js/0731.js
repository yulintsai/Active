$(document).ready(function() {
    /*xmlhttp.readyState
       0: 請求未初始化
       1: 服物器連接已建立
       2: 請求已接收
       3: 請求處理中
       4: 請求已完成，且響應已就緒
       
       xmlhttp.status
       200: "OK"
       404: 未找到页面*/

    function show() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("Event_box").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST", "/Active/Event/show", true);
        xmlhttp.send();
        var t = setTimeout(show, 1000);
    }
    
    show();






    // $.ajax({url:'/Active/Event/show',type:'POST',success:function(data){$('#Event_box').html(data);}});
    //   function ShowOnlinePlayers(){
    //           $.ajax({url:'/Active/Event/show',type:'POST',success:function(data){$('#Event_box').html(data);}});
    //           var t=setTimeout(ShowOnlinePlayers,1000);
    //       };      
    //           ShowOnlinePlayers();

    /*------------------------登出事件--------------------------*/
    $('#logout').click(function() { //登出事件


        if (confirm("Are You Sure to Logout?")) {
            document.location.href = "/Active/Login/logout";

        }
        else {
            //alert("你按下取消");
        }
    })

    $('.dt').datetimebox({
        formatter: function(date) {
            var y = date.getFullYear();
            var m = date.getMonth() + 1;
            var d = date.getDate();
            var H = date.getHours();
            var min = date.getMinutes();
            return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d) + ' ' + H + ':' + min + ':00';
        },
        parser: function(s) {
            var t = Date.parse(s);
            if (!isNaN(t)) {
                return new Date(t);
            }
            else {
                return new Date();
            }
        }
    });
});