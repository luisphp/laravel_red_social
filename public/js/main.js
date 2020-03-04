window.addEventListener("load", function() {

    //Seleccionar los elementos y mostrar un cursor de tipo pointer al pasar el mouse
    $('.like').css('cursor', 'pointer');
    $('.dislike').css('cursor', 'pointer');

    //Declarar URL raíz para las consultas
    var url = "localhost/laravel_red_social/public/"

    //Funcion para dar like a la publicación

    function like() {
        $(".like").unbind('click').click(function() {

            //Subir contador de likes

            //var counter = $('#contador').data('value').replace("(", "").replace(")", "");

            //var total = counter + 1;

            //$('#contador').text(total);

            //Mostrar mensaje en consola

            console.log("Has dado dislike");

            //Cambiar imagen del corazon para mostrar que se ha dado dislike

            $(this).addClass('dislike').removeClass('like').attr('src', 'http://localhost/laravel_red_social/public/images/unlike.png');


            //Hacer peticion Axios a la url que responde al like

            axios.get('http://localhost/laravel_red_social/public/dislike/' + $(this).data('id'))
                .then(function(response) {
                    // Mosrar el mensaje en la consola
                    console.log(response);
                })
                .catch(function(error) {
                    // Mostar error en la consola
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
            dislike();
        });

    };
    like();

    //Funcion para dar like a la publicación
    function dislike() {
        $(".dislike").unbind('click').click(function() {

            //Bajar contador de likes

            //var counter = $('#contador').data('value').replace("(", "").replace(")", "");

            //var total = counter - 1;

            //$('#contador').text(total);

            //Mostrar mensaje en consola

            console.log("Has dado like");

            //Cambiar imagen del corazon para mostrar que se ha dado dislike

            $(this).addClass('like').removeClass('dislike').attr('src', 'http://localhost/laravel_red_social/public/images/like.png');

            //Hacer peticion Axios a la url que responde al like

            axios.get('http://localhost/laravel_red_social/public/like/' + $(this).data('id'))
                .then(function(response) {
                    // handle success
                    console.log(response);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .then(function() {
                    // always executed
                });
            like();
        });

    }
    dislike();


    //Buscador
    $('#buscador').submit(function(e) {

        $(this).attr('action', 'http://localhost/laravel_red_social/public/user/all/' + $("#buscador #search").val());

    });


});