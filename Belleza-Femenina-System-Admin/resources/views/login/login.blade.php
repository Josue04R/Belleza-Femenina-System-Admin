<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ url('/css/login/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="loginContainer" id="container">

        <!-- Login Empleados -->
        <div class="formContainer signInContainer">
            <form method="POST" action="{{ route('empleado.login') }}">
                @csrf
                <h1>Login Empleados</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <span>Ingresa tus datos</span>
                <input type="text" name="usuario" class="formControlFeminine" placeholder="Usuario" required />
                <input type="password" name="contrasenia" class="formControlFeminine" placeholder="Contraseña" required />
                <a href="#">Olvidaste tu contraseña</a>
                <button class="btnFeminine">Iniciar sesión</button>
            </form>
        </div>

    </div>

    <script src="{{ url('/js/login/login.js') }}"></script>
</body>
</html>
