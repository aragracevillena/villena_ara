<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - User Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pinky: {
              50: '#fff5f7',
              100: '#ffe4e8',
              200: '#fbc6d0',
              300: '#f7a8ba',
              400: '#f285a3',
              500: '#ec5e89',
              600: '#d94b76',
              700: '#b33961',
              800: '#8c2f50',
              900: '#66203a',
            },
          },
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'sans-serif'],
          },
        },
      },
    };
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #fff5f7, #ffe4e8);
      min-height: 100vh;
      overflow-x: hidden;
    }
    .header-glow {
      text-shadow: 0 0 10px rgba(236, 94, 137, 0.5);
    }
    .card-shadow {
      box-shadow: 0 10px 25px -5px rgba(236, 94, 137, 0.2), 0 5px 10px -5px rgba(0, 0, 0, 0.05);
    }
    .btn-primary {
      background: linear-gradient(to right, #ec5e89, #d94b76);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(to right, #d94b76, #b33961);
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(236, 94, 137, 0.3);
    }
    .form-input, .form-select {
      background: #fff5f7;
      border: 1px solid #fbc6d0;
      color: #66203a;
    }
    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #ec5e89;
      box-shadow: 0 0 0 3px rgba(236, 94, 137, 0.3);
    }
    .form-input::placeholder {
      color: #f285a3;
      opacity: 0.7;
    }
    .action-btn {
      transition: all 0.2s ease;
    }
    .action-btn:hover {
      transform: translateY(-2px);
    }
    .error-message {
      background: rgba(255, 100, 100, 0.15);
      border: 1px solid rgba(255, 100, 100, 0.3);
    }

    /* Starry pink background */
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
      background: #ec5e89;
      border-radius: 50%;
      animation: twinkle 4s infinite ease-in-out;
    }

    .glowing-star {
      position: absolute;
      background: radial-gradient(circle, #fbc6d0, #ec5e89, transparent);
      border-radius: 50%;
      filter: blur(1px);
      animation: glow-pulse 3s infinite ease-in-out;
    }

    .shooting-star {
      position: absolute;
      width: 2px;
      height: 2px;
      background: linear-gradient(45deg, transparent, #d94b76, transparent);
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

    /* Glowing Border */
    .glow-border {
      position: relative;
      background: #66203a;
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
        #ec5e89, 
        #f285a3, 
        #f7a8ba, 
        #ec5e89);
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
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    .glow-button:hover::before {
      left: 100%;
    }
  </style>
</head>
<body class="text-pinky-100">
  <div class="stars-background" id="starsBackground"></div>

  <div class="container mx-auto px-4 py-8 max-w-md relative z-10">
    <header class="mb-8 text-center">
      <h1 class="text-4xl font-bold text-pinky-900 header-glow mb-2">User Management System</h1>
      <p class="text-pinky-800 font-medium">Create a new account</p>
    </header>

    <div class="glow-border card-shadow rounded-xl overflow-hidden border border-pinky-700">
      <div class="px-6 py-4 border-b border-pinky-700">
        <h2 class="text-xl font-semibold text-pinky-100 text-center">
          <i class="fas fa-user-plus mr-2 text-pinky-400"></i>Register
        </h2>
      </div>

      <div class="p-6">
        <?php if (!empty($error)): ?>
          <div class="error-message px-4 py-3 rounded-lg text-red-300 mb-6 text-center">
            <i class="fas fa-exclamation-circle mr-2"></i><?= $error ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('auth/register'); ?>" class="space-y-6">
          <div>
            <label class="block text-pinky-200 mb-2 font-medium"><i class="fas fa-user mr-2 text-pinky-400"></i>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinky-400">
          </div>

          <div>
            <label class="block text-pinky-200 mb-2 font-medium"><i class="fas fa-envelope mr-2 text-pinky-400"></i>Email</label>
            <input type="email" name="email" placeholder="Enter your email address" required class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinky-400">
          </div>

          <div>
            <label class="block text-pinky-200 mb-2 font-medium"><i class="fas fa-lock mr-2 text-pinky-400"></i>Password</label>
            <div class="relative">
              <input type="password" name="password" id="password" placeholder="Enter your password" required class="form-input w-full px-4 py-3 pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinky-400">
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-pinky-600 hover:text-pinky-700">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="block text-pinky-200 mb-2 font-medium"><i class="fas fa-lock mr-2 text-pinky-400"></i>Confirm Password</label>
            <div class="relative">
              <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm your password" required class="form-input w-full px-4 py-3 pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinky-400">
              <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-pinky-600 hover:text-pinky-700">
                <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="block text-pinky-200 mb-2 font-medium"><i class="fas fa-user-tag mr-2 text-pinky-400"></i>Role</label>
            <select name="role" required class="form-select w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pinky-400">
              <option value="user" selected>User</option>
              <option value="admin">Admin</option>
            </select>
          </div>

          <button type="submit" class="btn-primary glow-button text-white w-full py-3 rounded-lg flex items-center justify-center space-x-2 action-btn">
            <i class="fas fa-user-plus"></i>
            <span class="font-semibold">Create Account</span>
          </button>
        </form>

        <div class="mt-6 pt-6 border-t border-pinky-800 text-center">
          <p class="text-pinky-300 text-sm">
            Already have an account? 
            <a href="<?= site_url('auth/login'); ?>" class="text-pinky-400 font-medium hover:text-pinky-300 transition-colors">Login here</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const starsBackground = document.getElementById('starsBackground');
      for (let i = 0; i < 100; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        star.style.width = `${Math.random() * 2 + 1}px`;
        star.style.height = star.style.width;
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

      function setupPasswordToggle(toggleId, inputId, iconId) {
        const toggle = document.getElementById(toggleId);
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        toggle.addEventListener('click', function () {
          const type = input.type === 'password' ? 'text' : 'password';
          input.type = type;
          icon.classList.toggle('fa-eye-slash');
          icon.classList.toggle('fa-eye');
        });
      }
      setupPasswordToggle('togglePassword', 'password', 'togglePasswordIcon');
      setupPasswordToggle('toggleConfirmPassword', 'confirmPassword', 'toggleConfirmPasswordIcon');
    });
  </script>
</body>
</html>
