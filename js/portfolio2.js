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

    $('#contact-form').submit(function(e)
    {
        e.preventDefault();
        $('comments').empty();
        var postdata = $('#contact-form').serialize();

        $.ajax(
        {
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(result)
            {
                if(result.isSuccess)
                {
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé.</p>");
                    $('#contact-form')[0].reset();
                }
                else
                {
                    $('#fistname + .comments').html(result.firstnameError);
                    $('#name + .comments').html(result.nameError);
                    $('#email + .comments').html(result.emailError);
                    $('#phone + .comments').html(result.phoneError);
                    $('#message + .comments').html(result.messageError);
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