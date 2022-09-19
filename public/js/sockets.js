var image ="";
$(function (){
 
   
    let $chatInput = $(".msg");
    let $msg_inputs = $(".msg_inputs");
    let $chatBody = $(".messages");
    
    

    
    let user_id = "{{ auth()->user()->id }}";
    let friendId = "{{ $friendData->id }}";
    let ip_address = '127.0.0.1';
    let socket_port = '8005';
    let socket = io(ip_address + ':' + socket_port);

    socket.on('connect', function() {
       socket.emit('user_connected', user_id);
    });

    socket.on('updateUserStatus', (data) => {
        let $userStatusIcon = $('.chat_status_sign');
        $userStatusIcon.removeClass('online');
        
        $.each(data, function (key, val) {
           if (val !== null && val !== 0) {
                let $userIcon = "chat_status_sign "+key;
              console.log(key);
                if(document.getElementById(key.toString()))
                {
                    console.log("online");
                    document.getElementById(key.toString()).className="chat_status_sign online";
                }
                
           }else{
              
            if(document.getElementById(key.toString()))
                {
                    console.log("offline");
                    document.getElementById(key.toString()).className="chat_status_sign offline";
                }
           }
        });
    });

    $("#msg").emojioneArea({ events: {
        keydown: function (editor, e) {
        if (e.which === 13 && !e.shiftKey) {
           
            let message=$("#msg").data("emojioneArea").getText("");
            $(".emojionearea-editor").html('');
           
            sendMessage(message);
            return false; 
       }
    }
    }
});

   /*  $chatInput.keypress(function (e) {
        console.log("hdhsh");
       let message = this.value;
    
       if (e.which === 13 && !e.shiftKey) {
           
           $chatInput.val("");
           sendMessage(message);
           return false;
       }
    });
    
*/
    document.getElementById("send_msg").addEventListener("click", sendMsg);


   
    function sendMessage(message) {
        let url = "{{ route('message.send-message') }}";
        let form = $(this);
        let formData = new FormData();
        let token = "{{ csrf_token() }}";

        formData.append('message', message);
        formData.append('_token', token);
        formData.append('receiver_id', friendId);

        appendMessageToSender(message);

        $.ajax({
           url: url,
           type: 'POST',
           data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
           success: function (response) {
               if (response.success) {
                   console.log(response.data);
               }
           }
        });
    }


    function appendMessageToSender(message) {
        let name = '{{ $myInfo->name }}';
        var date='<?echo date("Y-m-d H:i");?>';

        let userInfo = `<div class="msg_block to">
        <div class="msg_text">
        <ul class="msg">
        
            <li class="me"><div class="me_img"><img src="`+image+`"></div>`+message+`</li>
        </ul>
        <div class="msg_date"><?php echo date('Y-m-d H:i');?></div>
            </div>
            <div class="msg_propic"><div class="msg_propic_roundness"><img src="{{ asset('img/default.png') }}"></div></div>
        </div>`;



        $chatBody.append(userInfo);
    }

    function appendMessageToReceiver(message) {
        let name = '{{ $friendData->name }}';
        var date='<?echo date("Y-m-d H:i");?>';
        console.log("dsd "+message);
        let userInfo = '<div class="msg_block from">\n'+
        '<div class="msg_propic">\n'+
        '<div class="msg_propic_roundness"><img src="{{ asset('img/default.png') }}"></div>\n'+
        '</div>\n'+
        `<div class="msg_text">
            <ul class="msg">
                <li class="him">`+message.content+`</li>
            </ul>
            <div class="msg_date">`+dateFormat(message.created_at)+" "+timeFormat(message.created_at)+`</div>
        </div>
        </div></div>`; 

        var link = "{{route('list-message', '')}}"+"/"+message.sender_id;

        $.ajax({
            url: link,
            success: function(response) {
                $('.chats').html(response);
            }
        });

        $chatBody.append(userInfo);
    }

    socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message)
    {
       
       appendMessageToReceiver(message);
    });

    function sendMsg(){
        let message=$("#msg").data("emojioneArea").getText("");
        $(".emojionearea-editor").html('');
            
        sendMessage(message);
    }


});
function editProfile(){ alert("coming soon");}
function open_emojis(){
}
function open_attachments(){ alert("coming soon");}

function readURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    document.getElementById('attachment').style.display = "flex";
    $('#blah').show();
    reader.onload = function (e) {
        image=e.target.result;
        $('#blah').attr('src', e.target.result);
        
    }
    
    reader.readAsDataURL(input.files[0]);
}
}

$("#file_upload").change(function(){
readURL(this);
});

