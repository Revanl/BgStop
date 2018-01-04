$(document).ready(function(){
//Open contacts manager
    $(".openContacts").click(function(){
        $(".unSeenBox").slideUp();
        $(".contactsBox").slideToggle();
    });

    $(".openUnseen").click(function(){
        $(".contactsBox").slideUp();
        $(".unSeenBox").slideToggle();
    });


//Unlocks chat with the person
    $(".unlockChat").click(function(){
        $(".chatBox").show();
    });

//Locks chat with the person
    $(".lockChat").click(function(){
        $(".chatBox").hide();
    });

//Hide chat box but don't lock
    $(".closeChat").click(function(){
        $(".chatBox"). hide();
    });

//Show chat box
    $(".openChat").click(function(){
        $(".chatBox").show();
    });


    $(".dropDownButton").click(function(){
        $("nav").toggle();
    });
    $(".triangleDown").click(function(){
        $close = $(this).find('.messageBox').toggle();
        $('.messageBox').not($close).hide();
    });

    $(".getChatFileUploader").click(function(){
        $(".chatFileUploader").trigger('click');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$('.openFriendChat').click(function(){
    var selectedFriend = $(this).attr('id');
    baseLocalUrl= "http://localhost:8000/setFriendChatSession";
    findContactUrl ="http://localhost:8000/findContactUrl";

        $.ajax({
            type: 'GET',
            url: findContactUrl,
            data: {selectedFriend: selectedFriend},
            success: function (data) {
                var JSONString1 = data;
                var JSONObject1 = JSON.parse(JSONString1);
                $('.chatTextBoxContact').html("");
                $('.chatTextBoxContact').append(JSONObject1 ['name']);
                $.ajax({
                    type: 'POST',
                    url: baseLocalUrl,
                    data: {selectedFriend: selectedFriend},
                    success: function (response) {
                        // Convert JSON String to JavaScript Object
                        var JSONString = response;
                        var JSONObject = JSON.parse(JSONString);
                        // alert(JSONObject[0]['name']);
                        $(".chatBox").show();
                        $('.chatTextBox').html("<br>");
                        for (var countMes = 0; countMes < JSONObject.length; countMes++) {
                            if (JSONObject[countMes]['sender'] == user) {
                                $('.chatTextBox').append(
                                    "<p class='alert alert-warning col-xs-12'>"
                                    + JSONObject[countMes]['message'] +
                                    "</p><br>");
                            } else {
                                $('.chatTextBox').append(
                                    "<div class='alert alert-info col-xs-12'>"
                                    + JSONObject[countMes]['message'] +
                                    "</div><br>");
                            }
                        }
                    }
                })
            }
        })
    });

    $('.sendMessage').click(function() {
        var message = $('.getMessage').val();
        $.ajax({
            type:'POST',
            url:'/send',
            data: {message:message},
            success: function(data){
                $(".getMessage").val('');
                refresh();
            },

            error: function(){
                alert('error');
            }
        });
    });

    function checkIfOpen() {
        if ($('.chatBox').css('display') == 'block') {
            setInterval(refresh, 5000);
        } else {

        }
    }

    setInterval(checkIfOpen, 5000);

    function refresh() {
        $.ajax({
            type: 'GET',
            url: '/refresh',
            success: function (response) {
                // Convert JSON String to JavaScript Object
                var JSONString = response;
                var JSONObject = JSON.parse(JSONString);


                $('.chatTextBox').html("<br>");

                for (var countMes = 0; countMes < JSONObject.length; countMes++) {
                    if (JSONObject[countMes]['sender'] == user) {
                        $('.chatTextBox').append(
                            "<p class='alert alert-warning col-xs-12'>"
                            + JSONObject[countMes]['message'] +
                            "</p><br>");
                    } else {
                        $('.chatTextBox').append(
                            "<div class='alert alert-info col-xs-12'>"
                            + JSONObject[countMes]['message'] +
                            "</div><br>");
                    }
                }
            }
        });
    }

    // function unSeenMessages(){
    //     unSeenBox
    // }

});