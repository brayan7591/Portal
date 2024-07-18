var contactform = {
    init: function() {
        var formElement = document.getElementById("contactform");
        formElement.addEventListener("submit", this.handleSubmit);
    },
    handleSubmit: function(event) {
        event.preventDefault();


        var name = document.getElementById("name").value;
        var celular = document.getElementById("celular").value;
        var email = document.getElementById("email").value;
        var mensaje = document.getElementById("mensaje").value;

        var formData = {
            name: name,
            celular: celular,
            email: email,
            mensaje: mensaje
        };


        alert(contactform.formatMensaje(formData));

        document.getElementById("contactform").reset();
    },


    formatMensaje: function(formData) {

        var mensaje = "hola " + formData.name + " nos comunicaremos con usted al correo electrónico " + formData.email + " o al numero de celular"+ formData.celular + " donde responderemos su mensaje.";
        return mensaje;
    }
};


contactform.init();