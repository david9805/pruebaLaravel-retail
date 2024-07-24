<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta - Amazon</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div id="snackbar">
        <p id="errorMessage"></p>
    </div>
    <div class="logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Amazon Logo">
    </div>
    <div class="container">
        
        <div class="form-container">
            <h1>Crear cuenta</h1>
            <form id="userForm">
                <label for="name">Tu nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombres y apellidos">
                
                <label for="email">Correo electrónico</label>
                <input type="text" id="email" name="email">

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Como mínimo 6 caracteres">
                <span class="info"><img src="image/info.svg" alt="Info" class="icon">   La contraseña debe contener al menos seis caracteres.</span>

                <label for="password-confirm">Vuelve a escribir la contraseña</label>
                <input type="password" id="password-confirm" name="password-confirm">

                <button type="submit" class="submit">Continuar</button>
            </form>
            <p class="legal">
                Al crear una cuenta, aceptas las <a href="#">Condiciones de Uso</a> y el 
                <a href="#">Aviso de Privacidad</a> de amazon.com.
            </p>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#userForm").on('submit',function (event){
            event.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var passwordConfirm = $('#password-confirm').val();            

            // Expresión regular para validar el formato del email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)){
                showError('Debe digitar correctamente el correo','error');
                return;
            }

            if(password.length < 6){
                showError('La contraseña debe tener minimo 6 caracteres','error');
                return;
            }

            if( password !== passwordConfirm){
                showError('Las contraseñas no coinciden','error');
                return;
            }
            $.ajax(
                {
                    url: "{{route('user')}}",
                    method:'POST',
                    contentType: 'application/json',
                    dataType: 'json',
                    data:JSON.stringify({
                        name: $('#name').val(),
                        email:$('#email').val(),
                        password:$('#password').val(),
                    }),
                    success:function(response){
                        showError('Registro Creado','sucess');
                    },
                    error:function(xhr){
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for(let error in errors){
                            errorMessage += errors[error] + '\n';
                        }

                        showError(errorMessage,'error');
                    }
                }
            )
        })
    })

    function showError(message,action){
        var error = $('#errorMessage');
        var color = action === 'error' ? '#ca5555' : '#40964c';
        $('#snackbar').css('background-color',color);
        $('#snackbar').addClass('show');                
        error.text(message);
        setTimeout(function() {
            $('#snackbar').removeClass('show');
        }, 3000); // El snackbar se oculta después de 3 segundos
    }
</script>
</html>

