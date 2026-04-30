<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Blog Cuaca - Portal informasi cuaca terkini dan terpercaya">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — Blog Cuaca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Animated Weather Background -->
    <div class="weather-bg">
        <img src="{{ asset('images/weather-bg.png') }}" alt="" class="bg-image">
        <div class="bg-overlay"></div>

        <!-- Floating Clouds -->
        <div class="cloud cloud-1">
            <svg viewBox="0 0 200 100" fill="none">
                <ellipse cx="70" cy="60" rx="60" ry="30" fill="rgba(255,255,255,0.15)"/>
                <ellipse cx="110" cy="50" rx="50" ry="25" fill="rgba(255,255,255,0.12)"/>
                <ellipse cx="140" cy="60" rx="40" ry="20" fill="rgba(255,255,255,0.1)"/>
            </svg>
        </div>
        <div class="cloud cloud-2">
            <svg viewBox="0 0 180 80" fill="none">
                <ellipse cx="60" cy="50" rx="50" ry="25" fill="rgba(255,255,255,0.1)"/>
                <ellipse cx="100" cy="42" rx="45" ry="22" fill="rgba(255,255,255,0.08)"/>
                <ellipse cx="130" cy="50" rx="35" ry="18" fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>
        <div class="cloud cloud-3">
            <svg viewBox="0 0 160 70" fill="none">
                <ellipse cx="55" cy="45" rx="45" ry="22" fill="rgba(255,255,255,0.12)"/>
                <ellipse cx="90" cy="38" rx="40" ry="20" fill="rgba(255,255,255,0.09)"/>
                <ellipse cx="115" cy="45" rx="30" ry="15" fill="rgba(255,255,255,0.07)"/>
            </svg>
        </div>

        <!-- Rain Drops -->
        <div class="rain-container" id="rainContainer"></div>

        <!-- Particles -->
        <div class="particles" id="particles"></div>
    </div>

    <!-- Main Login Container -->
    <main class="login-wrapper">
        <div class="login-card" id="loginCard">
            <!-- Left Side -->
            <div class="login-left">
                <!-- Logo & Branding -->
                <div class="brand-section">
                <div class="logo-icon">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Sun Rays -->
                        <path class="sun-rays" d="M50 22V14 M50 78V86 M22 50H14 M78 50H86 M69.8 30.2L75.5 24.5 M69.8 69.8L75.5 75.5 M30.2 69.8L24.5 75.5 M30.2 30.2L24.5 24.5" stroke="#FFC107" stroke-width="6" stroke-linecap="round"/>
                        <!-- Sun Core -->
                        <circle class="sun-core" cx="50" cy="50" r="22" fill="#FFC107"/>
                        <!-- Fluffy Cloud -->
                        <path class="cloud-path" d="M45 75 L90 75 A12 12 0 0 0 90 51 A18 18 0 0 0 60 45 A16 16 0 0 0 45 75 Z" fill="#E2E8F0" opacity="0.95"/>
                    </svg>
                </div>
                <h1 class="brand-title">Blog Cuaca</h1>
                <p class="brand-subtitle">Masuk ke akun Anda</p>
            </div>
            </div> <!-- End Left Side -->

            <!-- Right Side -->
            <div class="login-right">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login.store') }}" class="login-form">
                @csrf
                <div class="input-group" id="emailGroup">
                    <label for="email" class="input-label">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="input-field @error('email') input-error-field @enderror"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            required
                        >
                        <div class="input-focus-ring"></div>
                    </div>
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group" id="passwordGroup">
                    <label for="password" class="input-label">Kata Sandi</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="input-field @error('password') input-error-field @enderror"
                            placeholder="Masukkan kata sandi"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan kata sandi">
                            <svg class="eye-icon eye-open" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <svg class="eye-icon eye-closed" viewBox="0 0 20 20" fill="currentColor" style="display:none;">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                            </svg>
                        </button>
                        <div class="input-focus-ring"></div>
                    </div>
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="checkbox-label" for="rememberMe">
                        <input type="checkbox" id="rememberMe" class="checkbox-input">
                        <span class="checkbox-custom">
                            <svg viewBox="0 0 12 12" fill="none">
                                <path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="checkbox-text">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <span class="btn-text">Masuk</span>
                    <div class="btn-loader" id="btnLoader">
                        <div class="spinner"></div>
                    </div>
                    <svg class="btn-arrow" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">atau</span>
                <span class="divider-line"></span>
            </div>

            <!-- Register CTA -->
            <div class="register-cta">
                <p>Belum punya akun?</p>
                <a href="{{ route('register') }}" class="btn-register" id="btnRegister">
                    Daftar Sekarang
                    <svg viewBox="0 0 20 20" fill="currentColor" class="register-arrow">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <p>&copy; {{ date('Y') }} Blog Cuaca. Semua hak dilindungi.</p>
            </div>
            </div> <!-- End Right Side -->
        </div>
    </main>

    <script>
        // ===== Animated Rain Drops =====
        function createRain() {
            const container = document.getElementById('rainContainer');
            const dropCount = 40;
            for (let i = 0; i < dropCount; i++) {
                const drop = document.createElement('div');
                drop.classList.add('raindrop');
                drop.style.left = Math.random() * 100 + '%';
                drop.style.animationDuration = (Math.random() * 1 + 0.8) + 's';
                drop.style.animationDelay = Math.random() * 2 + 's';
                drop.style.opacity = Math.random() * 0.3 + 0.1;
                container.appendChild(drop);
            }
        }

        // ===== Floating Particles =====
        function createParticles() {
            const container = document.getElementById('particles');
            const count = 20;
            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = (Math.random() * 4 + 2) + 'px';
                particle.style.height = particle.style.width;
                particle.style.animationDuration = (Math.random() * 8 + 6) + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                container.appendChild(particle);
            }
        }

        // ===== Toggle Password Visibility =====
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = toggleBtn.querySelector('.eye-open');
        const eyeClosed = toggleBtn.querySelector('.eye-closed');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeOpen.style.display = isPassword ? 'none' : 'block';
            eyeClosed.style.display = isPassword ? 'block' : 'none';
        });

        // Add loading state on submit
        const loginForm = document.getElementById('loginForm');
        const btnLogin = document.getElementById('btnLogin');
        
        loginForm.addEventListener('submit', function() {
            btnLogin.classList.add('loading');
        });

        // ===== Input Focus Animations =====
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', () => {
                input.closest('.input-wrapper').classList.add('focused');
            });
            input.addEventListener('blur', () => {
                input.closest('.input-wrapper').classList.remove('focused');
            });
        });

        // ===== Initialize =====
        createRain();
        createParticles();

        // Entrance animation
        window.addEventListener('load', () => {
            document.getElementById('loginCard').classList.add('animate-in');
        });
    </script>
</body>
</html>
