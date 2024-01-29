// Función que se ejecuta al hacer clic en el botón "Enviar" en el formulario
function enviarFormulario() {
    // Obtiene el formulario por su ID
    var formulario = document.getElementById('contactForm');
    
    // Obtiene el elemento div para mostrar la respuesta del formulario por su ID
    var respuestaDiv = document.getElementById('respuesta');

    // Crea un objeto FormData que representa los datos del formulario
    var datos = new FormData(formulario);

    // Crea un objeto XMLHttpRequest para hacer una solicitud al servidor
    var xhr = new XMLHttpRequest();

    // Configura la solicitud POST para enviar los datos a 'data.php'
    xhr.open('POST', 'data.php', true);

    // Función que se ejecuta cuando la solicitud XMLHttpRequest se completa
    xhr.onload = function () {
        // Comprueba si el estado de la respuesta es 200 (éxito)
        if (xhr.status == 200) {
            // Coloca la respuesta del servidor en el div de respuesta
            respuestaDiv.innerHTML = xhr.responseText;

            // Resetea el formulario para que esté listo para otra entrada
            formulario.reset();
        } else {
            // Si la solicitud no es exitosa, muestra un mensaje de error en el div de respuesta
            respuestaDiv.innerHTML = 'Error en la solicitud.';
        }
    };

    // Envía la solicitud con los datos del formulario al servidor
    xhr.send(datos);
}
