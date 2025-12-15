@extends('layouts.auth')

@section('title', 'Autenticación')

@section('content')

<style>
/* ===== Floating Input ===== */
.floating-group {
    position: relative;
    margin-bottom: 1.6rem;
}

.floating-input {
    width: 100%;
    padding: 14px 12px;
    background-color: #EDFAFF;
    border: 1px solid #0378A6;
    border-radius: 6px;
    outline: none;
    font-size: 15px;
    color: #0378A6;
}

.floating-label {
    position: absolute;
    top: 50%;
    left: 12px;
    background-color: #EDFAFF;
    padding: 0 6px;
    color: #0378A6;
    font-size: 14px;
    pointer-events: none;
    transform: translateY(-50%);
    transition: all 0.2s ease;
}

.floating-input:focus + .floating-label,
.floating-input:not(:placeholder-shown) + .floating-label {
    top: -8px;
    font-size: 12px;
    opacity: 0;
}

.floating-input:focus {
    box-shadow: 0 0 0 0.15rem rgba(3, 120, 166, 0.25);
}

.floating-input::placeholder {
    color: transparent;
}

/* ===== Enlaces ===== */
.switch-link {
    color: #0378A6;
    cursor: pointer;
    font-weight: 600;
}

/* ===== Social buttons ===== */
.social-btn {
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 10px;
    width: 100%;
    background: #fff;
    margin-bottom: 10px;
    font-weight: 600;
}
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow" style="max-width:900px; width:100%;">
        <div class="row no-gutters" style="min-height:460px;">

            {{-- Imagen --}}
            <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center p-4">
                <img src="{{ asset('images/login.png') }}"
                     class="img-fluid"
                     style="max-height:340px;"
                     alt="Auth">
            </div>

            {{-- Formulario --}}
            <div class="col-md-6 d-flex align-items-center p-4">
                <form method="POST" action="{{ route('login') }}" class="w-100" id="authForm">
                    @csrf

                    <h4 class="text-center mb-4" id="formTitle">Inicio de sesión</h4>

                    {{-- EMAIL --}}
                    <div class="floating-group">
                        <input type="email" name="email" class="floating-input" placeholder=" " required>
                        <label class="floating-label">Correo electrónico</label>
                    </div>

                    {{-- USUARIO (solo registro) --}}
                    <div class="floating-group d-none" id="usernameField">
                        <input type="text" name="username" class="floating-input" placeholder=" ">
                        <label class="floating-label">Usuario</label>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="floating-group">
                        <input type="password" name="password" class="floating-input" placeholder=" " required>
                        <label class="floating-label">Contraseña</label>
                    </div>

                    {{-- CONFIRM PASSWORD (solo registro) --}}
                    <div class="floating-group d-none" id="confirmPasswordField">
                        <input type="password" name="password_confirmation" class="floating-input" placeholder=" ">
                        <label class="floating-label">Confirmar contraseña</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-2" id="submitBtn">
                        Iniciar sesión
                    </button>

                    {{-- LOGIN LINK --}}
                    <div class="text-center mt-3" id="loginText">
                        ¿Aún no tienes cuenta?
                        <span class="switch-link" onclick="switchToRegister()">Regístrate</span>
                    </div>

                    {{-- REGISTER EXTRA --}}
                    <div class="text-center mt-3 d-none" id="registerExtras">
                        <div class="mb-3">
                            <button type="button" class="social-btn">Continuar con Facebook</button>
                            <button type="button" class="social-btn">Continuar con Google</button>
                            <button type="button" class="social-btn">Continuar con Apple</button>
                        </div>

                        ¿Ya tienes cuenta?
                        <span class="switch-link" onclick="switchToLogin()">Inicia sesión</span>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection


@push('js')
<script>
function switchToRegister() {
    document.getElementById('formTitle').innerText = 'Registro';
    document.getElementById('submitBtn').innerText = 'Registrarse';
    document.getElementById('loginText').classList.add('d-none');
    document.getElementById('registerExtras').classList.remove('d-none');
    document.getElementById('usernameField').classList.remove('d-none');
    document.getElementById('confirmPasswordField').classList.remove('d-none');

    // Cambiar action si lo deseas
    document.getElementById('authForm').action = "{{ route('register') }}";
}

function switchToLogin() {
    document.getElementById('formTitle').innerText = 'Inicio de sesión';
    document.getElementById('submitBtn').innerText = 'Iniciar sesión';
    document.getElementById('loginText').classList.remove('d-none');
    document.getElementById('registerExtras').classList.add('d-none');
    document.getElementById('usernameField').classList.add('d-none');
    document.getElementById('confirmPasswordField').classList.add('d-none');

    document.getElementById('authForm').action = "{{ route('login') }}";
}
</script>
@endpush
