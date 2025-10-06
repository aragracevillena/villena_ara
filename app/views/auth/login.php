<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - User Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pinkshade: {
              50: '#fff5f8',
              100: '#ffe4ec',
              200: '#ffccd9',
              300: '#f9a8c3',
              400: '#f472b6',
              500: '#ec4899',
              600: '#db2777',
              700: '#be185d',
              800: '#9d174d',
              900: '#831843',
            }
          },
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #fff5f8, #ffe4ec);
      min-height: 100vh;
      overflow-x: hidden;
    }

    .header-glow {
      text-shadow: 0 0 10px rgba(236, 72, 153, 0.6);
    }

    .card-shadow {
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
      background: linear-gradient(to right, #ec4899, #db2777);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #db2777, #be185d);
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(236, 72, 153, 0.25);
    }

    .form-input {
      background: #fff5f8;
      border: 1px solid #ffccd9;
      color: #831843;
    }

    .form-input:focus {
      outline: none;
      border-color: #ec4899;
      box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.3);
    }

    .form-input::placeholder {
      color: #f472b6;
      opacity: 0.7;
    }

    .action-btn {
      transition: all 0.2s ease;
    }

    .action-btn:hover {
      transform: translateY(-2px);
    }

    .error-message {
      background: rgba(220, 38, 38, 0.15);
      border: 1px solid rgba(220, 38, 38, 0.3);
    }

    .stars-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }

    .star {
      position: absolute;
      background: #db2777;
      border-radius: 50%;
      animation: twinkle 4s infinite ease-in-out;
    }

    .glowing-star {
      position: absolute;
      background: radial-gradient(circle, #ec4899, #db2777, transparent);
      border-radius: 50%;
      filter: blur(1px);
      animation: glow-pulse 3s infinite ease-in-out;
    }

    .shooting-star {
      position: absolute;
      width: 2px;
      height: 2px;
      background: linear-gradient(45deg, transparent, #be185d, transparent);
      border-radius: 50%;
      animation: shoot 3s infinite linear;
    }

    @keyframes twinkle {
      0%, 100% { opacity: 0.2; transform: scale(1); }
      50% { opacity: 0.6; transform: scale(1.2); }
    }

    @keyframes glow-pulse {
      0%, 100% { opacity: 0.3; transform: scale(1); filter: blur(1px) brightness(1); }
      50% { opacity: 0.7; transform: scale(1.3); filter: blur(2px) brightness(1.3); }
    }

    @keyframes shoot {
      0% { transform: translateX(-100px) translateY(-100px) rotate(45deg); opacity: 0; }
      10% { opacity: 0.8; }
      100% { transform: translateX(100vw) translateY(100vh) rotate(45deg); opacity: 0; }
    }

    .glow-border {
      position: relative;
      background: #831843;
      border-radius: 16px;
      overflow: hidden;
    }

    .glow-border::before {
      content: '';
      position: absolute;
      top: -3px;
      left: -3px;
      right: -3px;
      bottom: -3px;
      background: linear-gradient(45deg,
        #f472b6,
        #ec4899,
        #f9a8c3,
        #ec4899,
        #f472b6);
      border-radius: 18px;
      z-index: -1;
      filter: blur(12px);
      opacity: 0.8;
      animation: border-glow 3s ease-in-out infinite alternate;
    }

    @keyframes border-glow {
      0% { opacity: 0.6; filter: blur(12px) brightness(1); }
      50% { opacity: 0.9; filter: blur(15px) brightness(1.3); }
      100% { opacity: 0.7; filter: blur(12px) brightness(1.1); }
    }

    .glow-button {
      position: relative;
      overflow: hidden;
    }

    .glow-button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent);
      transition: left 0.5s;
    }

    .glow-button:hover::before {
      left: 100%;
    }
  </style>
</head>

<body class="text-pinkshade-100">
  <div class="stars-background" id="starsBackground"></div>

  <div class="container mx-auto px-4 py-8 max-w-md relative z-10">
    <header class="mb-8 text-center">
      <h1 class="text-4xl font-bold text-pinkshade-900 header-glow mb-2">User Management System</h1>
      <p class="text-pinkshade-800 font-medium">Sign in to your account</p>
    </header>

    <div class="glow-border card-shadow rounded-xl overflow-hidden border border-pinkshade-700">
      <div class="px-6 py-4 border-b border-pinkshade-700">
        <h2 class="text-xl font-semibold text-pinkshade-100 text-center">
          <i class="fas fa-sign-in-alt mr-2 text-pinkshade-400"></i>Login
        </h2>
      </div>

      <div class="p-6">
        <?php if (!empty($error)): ?>
          <div class="error-message px-4 py-3 rounded-lg text-red-300 mb-6 text-center">
            <i class="fas fa-exclamation-circle mr-2"></i><?= $error ?>
          </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/login') ?>" class="space-y-6">
          <div>
            <label class="block text-pinkshade-200 mb-2 font-medium">
              <i class="fas fa-user mr-2 text-pinkshade-400"></i>Username
            </label>
            <input type="text" name="username" placeholder="Enter your username" required
              class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinkshade-400">
          </div>

          <div>
            <label class="block text-pinkshade-200 mb-2 font-medium">
              <i class="fas fa-lock mr-2 text-pinkshade-400"></i>Password
            </label>
            <div class="relative">
              <input type="password" name="password" id="password" placeholder="Enter your password" required
                class="form-input w-full px-4 py-3 pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinkshade-400">
              <button type="button" id="togglePassword"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-pinkshade-600 hover:text-pinkshade-700">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <button type="submit"
            class="btn-primary glow-button text-white w-full py-3 rounded-lg flex items-center justify-center space-x-2 action-btn">
            <i class="fas fa-sign-in-alt"></i>
            <span class="font-semibold">Login</span>
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-pinkshade-800 text-center">
          <p class="text-pinkshade-300 text-sm">
            Don't have an account?
            <a href="<?= site_url('auth/register'); ?>"
              class="text-pinkshade-400 font-medium hover:text-pinkshade-300 transition-colors">
              Register here
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const starsBackground = document.getElementById('starsBackground');

      for (let i = 0; i < 120; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        const size = Math.random() * 2 + 1;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.left = `${Math.random() * 100}%`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.animationDelay = `${Math.random() * 4}s`;
        starsBackground.appendChild(star);
      }

      for (let i = 0; i < 40; i++) {
        const glowingStar = document.createElement('div');
        glowingStar.classList.add('glowing-star');
        const size = Math.random() * 4 + 2;
        glowingStar.style.width = `${size}px`;
        glowingStar.style.height = `${size}px`;
        glowingStar.style.left = `${Math.random() * 100}%`;
        glowingStar.style.top = `${Math.random() * 100}%`;
        glowingStar.style.animationDelay = `${Math.random() * 3}s`;
        starsBackground.appendChild(glowingStar);
      }

      for (let i = 0; i < 6; i++) {
        const shootingStar = document.createElement('div');
        shootingStar.classList.add('shooting-star');
        shootingStar.style.left = `${Math.random() * 20}%`;
        shootingStar.style.top = `${Math.random() * 20}%`;
        shootingStar.style.animationDelay = `${Math.random() * 10}s`;
        starsBackground.appendChild(shootingStar);
      }

      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');
      const toggleIcon = document.querySelector('#toggleIcon');

      togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
      });
    });
  </script>
</body>
</html>
