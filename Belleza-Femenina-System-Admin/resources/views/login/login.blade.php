<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/login/login.css') }}">
</head>
<body>
    <div class="bgEffect bgEffect1"></div>
    <div class="bgEffect bgEffect2"></div>
    <div class="bgEffect bgEffect3"></div>
    
    <div class="loginContainer">
        <div class="graphicSide">
            <div class="graphicContent">
                <div class="graphicIcon">
                    <i class="fas fa-heart"></i>
                </div>
                <h2>Bienvenida a Nuestro Equipo</h2>
                <p>Accede a tu espacio de trabajo para llevar un control de todo lo que usted venda</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-lock"></i>
                        <span>Seguro y confiable</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-bolt"></i>
                        <span>Acceso rápido</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="formSide">
            <div class="logo">
                <h1>Belleza<span>Fememina</span></h1>
            </div>
            
            <div class="formContainer">
                <form method="POST" action="{{ route('empleado.login') }}">
                    @csrf
                    <h1>Iniciar Sesión</h1>
                    <span>Ingresa tus credenciales para acceder al sistema</span>

                    @if($errors->any())
                        <div class="alert alertDanger">
                            @foreach($errors->all() as $error)
                                <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alertSuccess">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <div class="inputGroup">
                        <input type="text" name="usuario" class="formControlFeminine" placeholder="Usuario" required />
                        <i class="fas fa-user"></i>
                    </div>
                    
                    <div class="inputGroup">
                        <input type="password" name="contrasenia" class="formControlFeminine" placeholder="Contraseña" required />
                        <i class="fas fa-lock"></i>
                    </div>
                    
                    <a href="#" class="forgotLink">¿Olvidaste tu contraseña?</a>
                    
                    <button class="btnFeminine">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('/js/login/login.js') }}"></script>
</body>
</html>