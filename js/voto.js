$(document).ready(function () {
    // Manejador de clic para el botón "like"
    $('.like-button').click(function () {
        console.log("like-button");
        const button = $(this);
        const dislikeButton = button.closest('.card').find('.dislike-button'); // Botón "dislike" en la misma tarjeta
        const likeCount = button.find('.like-count'); // Contador de "Me gusta" en la misma tarjeta
        const dislikeCount = dislikeButton.find('.dislike-count'); // Contador de "No me gusta" en la misma tarjeta
        const pistaId = button.data('pista-id');
        const usuarioId = button.data('usuario-id');
        const actionLike = 'like';

        // Realiza una solicitud AJAX al servidor para procesar el "like"
        $.ajax({
            type: 'POST',
            url: 'procesar-like-dislike.php',
            data: { pistaId: pistaId, usuarioId: usuarioId, action: actionLike },
            success: function (response) {
                if (response === 'liked') {
                    console.log("liked");
                    button.addClass('liked');
                    likeCount.text(parseInt(likeCount.text()) + 1); // Actualiza el contador de "Me gusta"
                    
                    // Asegurémonos de que el botón "dislike" no tenga la clase "disliked"
                    if (dislikeButton.hasClass('disliked')) {
                        dislikeButton.removeClass('disliked');
                        dislikeCount.text(parseInt(dislikeCount.text()) - 1); // Disminuye el contador de "No me gusta"
                    }
                } else if (response === 'unliked') {
                    console.log("unliked");
                    button.removeClass('liked');
                    likeCount.text(parseInt(likeCount.text()) - 1); // Disminuye el contador de "Me gusta"
                }
            }
        });
    });

    // Manejador de clic para el botón "dislike"
    $('.dislike-button').click(function () {
        const button = $(this);
        const likeButton = button.closest('.card').find('.like-button'); // Botón "like" en la misma tarjeta
        const dislikeCount = button.find('.dislike-count'); // Contador de "No me gusta" en la misma tarjeta
        const likeCount = likeButton.find('.like-count'); // Contador de "Me gusta" en la misma tarjeta
        const pistaId = button.data('pista-id');
        const usuarioId = button.data('usuario-id');
        const actionDislike = 'dislike';

        // Realiza una solicitud AJAX al servidor para procesar el "dislike"
        $.ajax({
            type: 'POST',
            url: 'procesar-like-dislike.php',
            data: { pistaId: pistaId, usuarioId: usuarioId, action: actionDislike },
            success: function (response) {
                if (response === 'disliked') {
                    console.log("disliked");
                    button.addClass('disliked');
                    dislikeCount.text(parseInt(dislikeCount.text()) + 1); // Actualiza el contador de "No me gusta"
                    
                    // Asegurémonos de que el botón "like" no tenga la clase "liked"
                    if (likeButton.hasClass('liked')) {
                        likeButton.removeClass('liked');
                        likeCount.text(parseInt(likeCount.text()) - 1); // Disminuye el contador de "Me gusta"
                    }
                } else if (response === 'undisliked') {
                    console.log("undisliked");
                    button.removeClass('disliked');
                    dislikeCount.text(parseInt(dislikeCount.text()) - 1); // Disminuye el contador de "No me gusta"
                }
            }
        });
    });

});
