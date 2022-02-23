$(function ()
{
    $('#contact-form').submit(function(e){                                                // lorsqu'on soumet le fomulaire #contact-form voila ce qui se passe Jquery

        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();                                   // recuperation des information du formulaire, les serialiser et les mettre dans une variable postdata

        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {                                                   // Si ajax est un succèes, il  exécute function et recupère resultat: qui est le résultat renvoyé par a page php

                if(json.isSuccess)
                {
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté :)</p>");
                    $('#contact-form')[0].reset();                                        // la fonction [0] reset() remet à 0 tout les élemets du formulaire de contacte
                }
                else
                {
                    $('#firstname + .comments').html(json.firstnameError);                // ceci me permet d<avoir acces a l<element qui suit directement #firstname, lui appliquer une fonction html et lui passer un elet.
                    $('#name + .comments').html(json.nameError);
                    $('#email + .comments').html(json.emailError);
                    $('#phone + .comments').html(json.phoneError);
                    $('#message + .comments').html(json.messageError);           
                }
                
            }


        });

    });
})