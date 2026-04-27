<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profil Pengguna - Blog Cuaca">
    <title>Profil Saya — Blog Cuaca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #764ba2;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 0.95rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .profile-sidebar {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            height: fit-content;
            text-align: center;
        }

        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            object-fit: cover;
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #667eea;
            color: white;
            border: 3px solid white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .avatar-upload-btn:hover {
            background: #764ba2;
            transform: scale(1.1);
        }

        .profile-info {
            margin-bottom: 1.5rem;
        }

        .info-label {
            font-size: 0.75rem;
            color: #999;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
            display: block;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .profile-divider {
            border-top: 1px solid #e0e0e0;
            margin: 1.5rem 0;
        }

        .logout-btn {
            width: 100%;
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .profile-forms {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
            padding-bottom: 1rem;
            border-bottom: 2px solid #667eea;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group-full {
            grid-column: 1 / -1;
        }

        .textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            display: none;
        }

        .file-input-label {
            display: block;
            padding: 1rem;
            background: #f9f9f9;
            border: 2px dashed #667eea;
            border-radius: 0.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: #f0f7ff;
            border-color: #764ba2;
        }

        .file-input-label span {
            font-weight: 600;
            color: #667eea;
        }

        .submit-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-text {
            display: block;
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .avatar-container {
                width: 120px;
                height: 120px;
            }

            .avatar {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <a href="{{ route('dashboard') }}" class="navbar-brand">☁️ Blog Cuaca</a>
            <div class="navbar-links">
                <a href="{{ route('dashboard') }}" class="nav-link">← Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">👤 Profil Saya</h1>
            <p class="page-subtitle">Kelola informasi pribadi dan keamanan akun Anda</p>
        </div>

        <!-- Profile Grid -->
        <div class="profile-grid">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="avatar-container">
                    @if (Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="avatar">
                    @else
                        <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    @endif
                    <label for="avatar-upload" class="avatar-upload-btn" title="Ubah Avatar">📸</label>
                    <input type="file" id="avatar-upload" accept="image/*" style="display: none;">
                </div>

                <div class="profile-info">
                    <span class="info-label">Nama</span>
                    <div class="info-value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile-info">
                    <span class="info-label">Email</span>
                    <div class="info-value" style="font-size: 0.95rem; word-break: break-all;">{{ Auth::user()->email }}</div>
                </div>

                @if (Auth::user()->bio)
                    <div class="profile-info">
                        <span class="info-label">Tentang</span>
                        <div class="info-value" style="font-size: 0.9rem; line-height: 1.5;">{{ Auth::user()->bio }}</div>
                    </div>
                @endif

                <div class="profile-divider"></div>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Keluar</button>
                </form>
            </div>

            <!-- Forms Section -->
            <div class="profile-forms">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Informasi Dasar -->
                <div class="form-card">
                    <h2 class="form-title">ℹ️ Informasi Dasar</h2>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Avatar Upload -->
                        <div class="form-group form-group-full">
                            <label class="form-label">Foto Profil (Avatar)</label>
                            <div class="file-input-wrapper">
                                <input 
                                    type="file" 
                                    name="avatar" 
                                    id="avatar-file" 
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                >
                                <label for="avatar-file" class="file-input-label">
                                    📷 <span>Klik untuk upload atau drag & drop</span>
                                    <div style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                                        Format: JPG, PNG, GIF (Max 2MB)
                                    </div>
                                </label>
                            </div>
                            @error('avatar')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Name & Email -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-input" 
                                    value="{{ old('name', Auth::user()->name) }}"
                                    required
                                >
                                @error('name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-input" 
                                    value="{{ old('email', Auth::user()->email) }}"
                                    required
                                >
                                @error('email')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="form-group form-group-full">
                            <label class="form-label">Tentang Anda (Bio)</label>
                            <textarea 
                                name="bio" 
                                class="form-input textarea" 
                                placeholder="Tulis sedikit tentang diri Anda... (maksimal 500 karakter)"
                                maxlength="500"
                            >{{ old('bio', Auth::user()->bio) }}</textarea>
                            @error('bio')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn">💾 Simpan Perubahan</button>
                    </form>
                </div>

                <!-- Ubah Password -->
                <div class="form-card">
                    <h2 class="form-title">🔐 Ubah Password</h2>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-group-full">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-input" 
                                placeholder="Biarkan kosong jika tidak ingin mengubah"
                                minlength="8"
                            >
                            <small style="color: #999;">Minimal 8 karakter</small>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-group-full">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                class="form-input" 
                                placeholder="Ketik ulang password baru"
                                minlength="8"
                            >
                            @error('password_confirmation')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn">🔐 Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Avatar upload preview
        document.getElementById('avatar-file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar').style.backgroundImage = `url(${e.target.result})`;
                    document.querySelector('.avatar').textContent = '';
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag & drop file upload
        const fileLabel = document.querySelector('.file-input-label');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileLabel.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            fileLabel.style.background = '#f0f7ff';
            fileLabel.style.borderColor = '#764ba2';
        }

        function unhighlight(e) {
            fileLabel.style.background = '#f9f9f9';
            fileLabel.style.borderColor = '#667eea';
        }

        fileLabel.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('avatar-file').files = files;
            
            // Trigger change event
            const event = new Event('change', { bubbles: true });
            document.getElementById('avatar-file').dispatchEvent(event);
        }
    </script>
</body>
</html>
