$(document).ready(function () {
    
    //baseUrl = http://nghetudo.vn/, http://admin.nghetudo.vn/
    //$audio_ogg = baseUrl + "ntd/media/isnt-it.ogg";
    //$audio_mp3 = baseUrl + "ntd/media/isnt-it.mp3";
    //$audio_wav = baseUrl + "ntd/media/isnt-it.m4r";
    //$('<audio id="chatAudio"><source src="' + $audio_ogg + '" type="audio/ogg"><source src="' + $audio_mp3 + '" type="audio/mpeg"><source src="' + $audio_wav + '" type="audio/wav"></audio>').appendTo('body');

    ion.sound({
        sounds: [
            {name: "notify"},
        ],

        // main config
        path: siteUrl + "/media/",
        preload: true,
        multiplay: true,
        volume: 0.9
    });

    var audioTimeout;
    pushNotifications();

    function pushNotifications()
    {
        audioTimeout = setTimeout( function(){
            pushNotifications();
        }, 15000 );
        getMessages();
        getNotifications();
    }    

    function getNotifications()
    {   
    	//Ajax den server kiem tra xem co tin moi haay ko. Neu co thi play sound
        ajaxUrl = '/notification/scanning';
        //Cac param, vi du get notification theo user nao dang online, (logged), tinh trang doc hay chua...
        //params = {comId: comId, postId: postId, pageId: pageId};
        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            //data: params,
            beforeSend: function () {
            },
            success: function (response) {
                var data = $.parseJSON(response);
                if (data.code == 2){
                    clearTimeout(audioTimeout);
                }
                if (data.code == 1) {
                    if (data.is_ring == 1) {
                        ion.sound.play("notify");
                    }
                    if (data.noti_count != 0) {
                        $('#label-noti-count').text(data.noti_count);
                        $('.nav-item-noti a.noti-label i').addClass('faa-ring animated');
                    } else {
                        console.log(1);
                        $('#label-noti-count').text('');
                    }
                }
                return;
            }
        });       
    }
    
    function getMessages()
    {   
        ajaxUrl = '/chat-rooms/scanning';
        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (response) {
                if (response.code == 2){
                    clearTimeout(audioTimeout);
                }
                if (response.code == 1) {
                    if (response.is_ring == 1) {
                        ion.sound.play("notify");
                    }
                    if (response.message_count != 0) {
                        $('#label-message-count').text(response.message_count);
                        $('.nav-item-message a.message-label i').addClass('faa-shake animated');
                    } else {
                        $('#label-meessage-count').text('');
                    }
                }
                return;
            }
        });       
    }

});