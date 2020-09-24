
//ANIMATION SCROLLTOP
$(function(){

    $(".navbar a, footer a").click(function(event){

        event.preventDefault();
        var hash = this.hash;
        $("html,body").animate({
            scrollTop:$(hash).offset().top}, 900, function(){window.location.hash = hash;})

    });


});

//CONTACT
$(function(){

    $('#contact-form').submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.isSuccess) 
                {
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");
                    $('#contact-form')[0].reset();
                }
                else
                {
                    $('#firstname + .comments').html(json.firstnameError);
                    $('#name + .comments').html(json.nameError);
                    $('#email + .comments').html(json.emailError);
                    $('#phone + .comments').html(json.phoneError);
                    $('#message + .comments').html(json.messageError);
                }                
            }
        });
    });

});


//map
$(function(){
    var location = {lat: 49.2833, lng: 6.2};

    var map = new google.maps.Map(document.getElementById('map'), {zoom: 12, center: location});
    var marker = new google.maps.Marker({position:location, map: map});


});

function getTime () { 
    var date = new Date(); 
    var hours = date.getHours(); 
    var minutes = date.getMinutes(); 
    var seconds = date.getSeconds(); 
    hours = ((hours < 10) ? " 0" : " ") + hours;
    minutes = ((minutes < 10) ? ":0" : ":") + minutes; 
    seconds = ((seconds < 10) ? ":0" : ":") + seconds; 
    var myHour = document.getElementById("hour");
    myHour.textContent = hours + minutes + seconds;
    setTimeout("getTime()",1000); 
    
}
getTime();