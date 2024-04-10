<?php 
// session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" href="images/logo2.png" type = "images/x-icon">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>CSKH</title>

    <style>
        .style3{
            color:red;
        }

        .chat-main {
            position: fixed;
            width: 30%;
            bottom: px;
            left: 600px;
            top: 100px;
        }

        .header-one {
            background: #404040;
        }

        .name h6 {
            display: inline-block;
            font-size: 14px;
        }

        .options i,
        .options .arrow-up {
            height: 25px;
            width: 25px;
        }

        .options i {
            color: #B2B2B2;
            font-size: 16px;
            cursor: pointer;
        }

        .options .hover:hover,
        .options .arrow-up:hover {
            background: #737373;
        }

        .options .arrow-up {
            display: inline-block;
            line-height: 0;
        }

        .options .hover:hover,
        .options .arrow-up:hover .fa-arrow-up {
            color: #fff;
        }

        .options .fa-arrow-up {
            transform: rotate(40deg);
        }

        .header-two {
            border-top: 2px solid #35AC19;
            background: #ECEFF1;
            color: #5E6060;
            padding: 8px 0px 4px 8px;
            box-shadow: 0px 6px 13px -7px #c1c1c1;
            z-index: 1000;
            position: absolute;
        }

        .options-left i,
        .options-right i {
            font-size: 20px;
            cursor: pointer;
        }

        .options-left i:hover,
        .options-right i:hover {
            color: #000;
        }

        .chats {
            height: 500px !important;
            overflow-x: scroll;
            overflow-x: hidden;
            background: #ECEFF1;
            position: relative;
            top: 0px;
            padding-bottom: 10px;
        }

        .chats ul li {
            display: inline-block;
            list-style: none;
            clear: both;
            font-size: 13px;
            margin: 8px;
        }

        .sender-img {
            display: inline;
        }

        .sender-img img {
            width: 32px;
            height: 32px;
            border-radius: 100%;
        }

        .receive-msg .receive-msg-desc {
            display: inline-block;
            position: relative;
        }

        .receive-msg-desc:before {
            content: "";
            width: 0;
            height: 0;
            top: 0px;
            left: -8px;
            position: absolute;
            border-top: 8px solid #fff;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
        }

        .receive-msg-time,
        .send-msg-time {
            color: #7D7E87;
            font-size: 10px;
        }

        .receive-msg-time i {
            font-size: 4px;
        }

        .msg-box {
            margin-top: 0px;
        }

        .msg-box i {
            color: #404040;
        }

        .msg-box input {
            font-size: 14px;
        }

        .msg-box input:focus {
            outline: none;
        }

        .send-msg {
            height: 80px;
            margin-right: 5px !important;
            margin-left: 2px !important;
        }

        img {
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 20px !important;
            width: 50px;
        }

        .btn-submit {
            margin-top: 5px !important;
            height: 35px;
        }

        .img-avata {
            top: 2px;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 5px;
            right: 10px;
            width: 20%;
            height: 20%;
        }

        .contents {
            outline: none !important;
            border-color: #719ECE;
            box-shadow: 0 0 10px #719ECE;
        }

        .div-contents {
            margin-left: -20px;
        }

        .form-container .btn:hover,
        .open-button:hover,
        .open-img:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 900px) {
            .chat-main {
                position: fixed;
                width: 60%;
                bottom: 79px;
                right: 27px;
            }
        }

        @media only screen and (max-width: 600px) {
            .chat-main {
                position: fixed;
                width: 50%;
                bottom: 79px;
                right: 27px;
            }
        }

        body{
            background: linear-gradient(to left, rgb(255, 121, 121), rgb(246, 229, 141), rgb(126, 214, 223));
        }
   </style>
    <link rel="stylesheet" href="./dist/bootstrap4.0.0css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./dist/jquery3.3.1/jquery.min.js"></script>
</head>

<body>

    &nbsp;<br>
    <img src="./img/messenger.png" alt="messenger" class="open-img" onclick="openForm()">
   <div class="chat-popup chatbotForm" id="myForm">
        <div class="container">
            <div class="row pt-3">
                <div class="chat-main">
                    <div class="col-md-12 chat-header">
                        <div class="row header-one text-white p-1">
                            <div class="col-md-6 name pl-2">
                                <i class="fa fa-comment"></i>
                                <h6 class="ml-1 mb-0">Chat</h6>
                            </div>
                            <div class="col-md-6 options text-right pr-0">
                                <i class="fa fa-window-minimize hide-chat-box hover text-center pt-1" onclick="closeForm()"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content">
                        <div class="col-md-12 chats">
                            <ul class="p-0 dataUL" id="dataULL">
                                <?php
                                    $api_url="https://api.telegram.org/bot6919248046:AAGSv19GGvCZ8ryZfzJfquZP_yRqU-Wk6Mw/getUpdates";
                                    
                                    $json_data = file_get_contents($api_url);

                                    $response_data = json_decode($json_data);

                                    $user_data = $response_data->result;


                                    foreach ($user_data as $user) {
                
                                        $message_id = $user->message->message_id;
                                        $text = $user->message->text;
                                        $date = $user->message->date;
                                        $_SESSION['group']['messageID'] = $message_id+1;
                                        echo '<li>';
                                            echo '<div class="row" id="load_data">';
                                                echo '<img src="./img/img-avata.png" alt="image" class="col-md-3 col-sm-3 float-left img-avata mediaImg">';
                                                    echo '<div class="col-md-6 col-sm-6 div-contents">';
                                                        echo '<span style="display:none">'.$message_id.'</span>';
                                                        echo '<h6 style="color:#B22222">'."Admin".'</h6>'; 
                                                        echo '<span>'.$text.'</span>';
                                                    echo '</div>';
                                                echo '<div class="col-md-3 col-sm-3">';
                                                    echo '<span>'.date('d/m/Y',$date).'</span>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</li>';
                                    }
                                    
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-12 p-2 msg-box border border-primary">
                       
                            <form id="formSubmit">
                                <div class="send-msg">
                                    <input type="hidden" name="messageID" value="<?php echo $_SESSION['group']['messageID'];?>" class="messageIDS"/>
                                    <input type="hidden" name="username" value="User" class="usernameIP"/>
                                    <textarea id="content" class="contents" name="content" rows="3" cols="45" style="width:100%" placeholder="Nhập nội dung" onkeypress="onTestChange()"></textarea><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    
        function onTestChange() {
            var key = window.event.keyCode;
            if (key === 13) {
                myTest();
            }
        }
        
        function myTest(){
            var messageID = $('.messageIDS').val();
            var usernameIP = $('.usernameIP').val();
            var contents = $('.contents').val();

            var today = new Date();
            var time = today.getDate()+"/"+ (today.getMonth()+1)+"/"+today.getFullYear();

            var li = document.createElement("li");
            
            var noiDungMoi = document.createTextNode(contents);
            
            li.appendChild(noiDungMoi);
            
            var contentSP = document.getElementById("dataULL");
        
            contentSP.appendChild(li).innerHTML = 
                '<div class="row">'
                    +'<img  src="./img/img-avata.png" alt="image" class="col-md-3 col-sm-3 float-left img-avata mediaImg">'
                    +'<div class="col-md-6 col-sm-6 div-contents">'
                        +'<span class="contentSP" id="idContentSP" style="display:none">'+messageID+'</span>'
                        +'<h6 style="color:#191970" class="usernameIDS">User</h6>'
                        +'<span class="contentSP" id="idContentSP">'+contents+'</span>'
                    +'</div>'
                    +'<div class="col-md-3 col-sm-3">'
                        +'<span>'+time+'</span>'
                    +'</div>'
                +'</div>';
            $.ajax({
                url:'https://api.telegram.org/bot6919248046:AAGSv19GGvCZ8ryZfzJfquZP_yRqU-Wk6Mw/sendMessage',
                method:'POST',
                data:{
                    chat_id: 1773862148,
                    text:usernameIP+ " OK "+messageID +" : "+contents,
                    },
                });

            myFunction();
            $('.contents').val('');
        }


        function myFunction() {
            setInterval(function(){
                
                $.ajax({
                    type: 'GET',
                    url: 'https://api.telegram.org/bot6919248046:AAGSv19GGvCZ8ryZfzJfquZP_yRqU-Wk6Mw/getUpdates',
                    dataType: 'html',
                    success: function(data) {
                    
                        var getData = $.parseJSON(data);
                        var str = "";
                        $.each(getData.result, function(index, item) {
                            var messageID = $('.messageIDS').val();
                            var usernameIP = $('.usernameIP').val();
                            var contents = $('.contents').val();

                            var message_id = item.message.message_id;
                            var first_name = item.message.from.first_name;
                            var last_name = item.message.from.last_name;
                            var text = item.message.text;

                            var today = new Date();
                            var time = today.getDate()+"/"+ (today.getMonth()+1)+"/"+today.getFullYear();


                            if(message_id > messageID){
                                str += '<li id="dataS">';
                                    str += '<div class="row">';
                                        str += '<img src="./img/img-avata.png" alt="image" class="col-md-3 col-sm-3 float-left img-avata mediaImg">';
                                        str += '<div class="col-md-6 col-sm-6 div-contents">';
                    
                                            str += '<h6 style="color:#B22222" class="usernameIDS">'+first_name+" "+last_name+'</h6>';
                                            str += '<span class="contentSP text-center">'+text+'</span>';
                                        str += '</div>';
                                        str += '<div class="col-md-3 col-sm-3">';
                                            str += '<span>'+time+'</span>';
                                        str += '</div>';                  
                                    str += '</div>';
                                str += '</li>';
                                $('.dataUL').html(str);

                                $('.messageIDS').val(message_id);
                            }
                        });
                    },
                });
            }, 700);
        }
    </script>

<script>
      
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }
    
        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function myFunctionMedia(x) {
            if (x.matches) {
                document.getElementsByClassName("chatbotForm")[0].style.display = "none";
            } else {
                document.getElementsByClassName("chatbotForm")[0].style.display = "block";
            }
        }

        var x = window.matchMedia("(max-width: 1100px)")
        myFunctionMedia(x)
        x.addListener(myFunctionMedia)
    </script>

</body>

</html>