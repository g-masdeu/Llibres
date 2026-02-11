@extends('layouts.welcome')
@section('title', 'Benvingut')
@section('content')

<div class="landing-page">
    <div class="container-fluid h-100">
        <div class="row align-items-center h-100 g-0">
            <!-- Left Column - Hero Content -->
            <div class="col-lg-6 hero-side" data-aos="fade-right">
                <div class="hero-content">
                    <div class="hero-badge mb-3">
                        <span class="badge-icon">📚</span>
                        <span class="badge-text">La teva biblioteca digital</span>
                    </div>
                    <h1 class="hero-title mb-3">
                        Descobreix el món dels 
                        <span class="gradient-text">llibres</span>
                    </h1>
                    <p class="hero-subtitle mb-4">
                        Valora, ressenya i descobreix noves lectures amb una comunitat apassionada pels llibres.
                    </p>
                    
                    <!-- Quick Features -->
                    <div class="quick-features mb-4">
                        <div class="quick-feature">⭐ Valora llibres</div>
                        <div class="quick-feature">🔍 Explora el catàleg</div>
                        <div class="quick-feature">👥 Comunitat activa</div>
                    </div>

                    <!-- Register CTA -->
                    <div class="hero-cta">
                        <a href="{{ route('register') }}" class="btn btn-cta">
                            <i class="fas fa-user-plus me-2"></i>Crea un compte gratuït
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Login Form -->
            <div class="col-lg-6 login-side" data-aos="fade-left">
                <div class="login-card">
                    <div class="login-header text-center mb-3">
                        <div class="login-icon mb-2">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="login-title mb-1">Inicia Sessió</h3>
                        <p class="login-subtitle">Continua la teva aventura literària</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Correu electrònic
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-modern" 
                                   placeholder="exemple@correu.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Contrasenya
                            </label>
                            <input type="password" name="password" id="password" class="form-control form-control-modern" 
                                   placeholder="••••••••" required>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label small" for="remember">
                                    Recorda'm
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="forgot-password small">
                                Contrasenya oblidada?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-gradient w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Entrar
                        </button>

                        <div class="text-center">
                            <p class="register-text small mb-0">
                                No tens compte? 
                                <a href="{{ route('register') }}" class="register-link">
                                    Registra't
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements (decorative) -->
    <div class="floating-elements">
        <div class="floating-book floating-1">📖</div>
        <div class="floating-book floating-2">📚</div>
        <div class="floating-book floating-3">✨</div>
        <div class="floating-book floating-4">⭐</div>
    </div>
</div>

<style>
    /* Landing Page Styles */
    html, body {
        overflow-x: hidden;
        max-width: 100vw;
    }

    .landing-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }

    .container-fluid, .row, .h-100 {
        height: 100vh;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .container-fluid {
        overflow-x: hidden;
    }

    /* Hero Side */
    .hero-side {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        height: 100%;
    }

    .hero-content {
        color: white;
        max-width: 500px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 1.2rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 0.85rem;
        animation: fadeInUp 0.8s ease;
    }

    .badge-icon {
        font-size: 1.2rem;
        margin-right: 0.4rem;
    }

    .badge-text {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.1;
        animation: fadeInUp 0.8s ease 0.2s backwards;
    }

    .gradient-text {
        background: linear-gradient(45deg, #f093fb, #f5576c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        line-height: 1.6;
        animation: fadeInUp 0.8s ease 0.4s backwards;
    }

    /* Quick Features */
    .quick-features {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease 0.6s backwards;
    }

    .quick-feature {
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .quick-feature:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }

    /* CTA Button */
    .hero-cta {
        animation: fadeInUp 0.8s ease 0.8s backwards;
    }

    .btn-cta {
        background: white;
        color: #764ba2;
        border: none;
        font-weight: 700;
        padding: 0.9rem 2rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        display: inline-block;
        text-decoration: none;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        background: #f8f9fa;
        color: #764ba2;
        text-decoration: none;
    }

    /* Login Side */
    .login-side {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        height: 100%;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.3);
        width: 100%;
        max-width: 420px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .login-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .login-title {
        color: #2d3748;
        font-weight: 800;
        font-size: 1.5rem;
    }

    .login-subtitle {
        color: #718096;
        margin: 0;
        font-size: 0.9rem;
    }

    .form-label {
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 0.4rem;
        font-size: 0.85rem;
    }

    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.15);
        background: white;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #764ba2;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.85rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        font-size: 1rem;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    }

    .register-text {
        color: #4a5568;
    }

    .register-link {
        color: #667eea;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .register-link:hover {
        color: #764ba2;
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .floating-book {
        position: absolute;
        font-size: 2.5rem;
        opacity: 0.08;
        animation: float 20s infinite ease-in-out;
    }

    .floating-1 {
        top: 10%;
        left: 8%;
        animation-delay: 0s;
    }

    .floating-2 {
        top: 70%;
        left: 88%;
        animation-delay: 3s;
    }

    .floating-3 {
        top: 25%;
        left: 85%;
        animation-delay: 6s;
    }

    .floating-4 {
        top: 85%;
        left: 12%;
        animation-delay: 9s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-40px) rotate(8deg);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile Optimizations */
    @media (max-width: 991px) {
        .landing-page {
            position: relative;
            min-height: 100vh;
            height: auto;
            width: 100%;
        }
        
        .container-fluid {
            height: auto;
            min-height: 100vh;
            padding: 0;
            width: 100%;
        }
        
        .row {
            height: auto;
            min-height: 100vh;
            margin: 0;
            width: 100%;
        }
        
        .hero-side, .login-side {
            min-height: 50vh;
            padding: 1.5rem 1rem;
            width: 100%;
        }

        .hero-content {
            max-width: 100%;
            width: 100%;
        }

        .hero-title {
            font-size: 2.2rem;
            word-wrap: break-word;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .login-card {
            max-height: none;
            padding: 1.5rem;
            width: 100%;
            max-width: 100%;
        }

        .quick-features {
            justify-content: center;
        }

        .hero-cta {
            text-align: center;
        }

        .btn-cta {
            width: auto;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .hero-side, .login-side {
            padding: 1rem 0.75rem;
        }

        .hero-content {
            padding: 0;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .hero-subtitle {
            font-size: 0.95rem;
        }

        .login-card {
            padding: 1.25rem 1rem;
            margin: 0;
        }

        .login-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }

        .login-title {
            font-size: 1.3rem;
        }

        .quick-feature {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .btn-cta {
            padding: 0.7rem 1.5rem;
            font-size: 0.9rem;
            width: auto;
        }

        .floating-book {
            font-size: 2rem;
        }

        .hero-badge {
            font-size: 0.75rem;
            padding: 0.3rem 1rem;
        }

        .badge-icon {
            font-size: 1rem;
        }
    }

    /* Very small screens */
    @media (max-width: 400px) {
        .hero-side {
            min-height: auto;
            padding: 1rem 0.5rem;
        }

        .login-side {
            padding: 1rem 0.5rem;
        }
        
        .hero-title {
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
        }
        
        .hero-subtitle {
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        
        .quick-features {
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .login-card {
            padding: 1rem 0.75rem;
        }
        
        .login-icon {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 0.75rem;
        }

        .form-control-modern {
            font-size: 0.9rem;
            padding: 0.65rem 0.85rem;
        }

        .btn-cta {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }
    }

</style>

@endsection
