<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Info - User Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#f8faf7',
                            100: '#e8efe6',
                            200: '#d2dfcd',
                            300: '#aec0a6',
                            400: '#849b7a',
                            500: '#647959',
                            600: '#4d5f43',
                            700: '#3e4c36',
                            800: '#333d2d',
                            900: '#2b3327',
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
            background: linear-gradient(135deg, #f8faf7, #e8efe6);
            min-height: 100vh;
            overflow-x: hidden;
        }
        .header-glow {
            text-shadow: 0 0 10px rgba(100, 121, 89, 0.6);
        }
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.05);
        }
        .btn-primary {
            background: linear-gradient(to right, #647959, #4d5f43);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #4d5f43, #3e4c36);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(77, 95, 67, 0.25);
        }
        .btn-update {
            background: linear-gradient(to right, #849b7a, #647959);
            transition: all 0.3s ease;
        }
        .btn-update:hover {
            background: linear-gradient(to right, #647959, #4d5f43);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(77, 95, 67, 0.25);
        }
        .btn-danger {
            background: linear-gradient(to right, #dc2626, #b91c1c);
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background: linear-gradient(to right, #b91c1c, #991b1b);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(185, 28, 28, 0.25);
        }
        .btn-logout {
            background: linear-gradient(to right, #dc2626, #b91c1c);
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: linear-gradient(to right, #b91c1c, #991b1b);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(185, 28, 28, 0.25);
        }
        .form-input {
            background: #f8faf7;
            border: 1px solid #d2dfcd;
            color: #2b3327;
        }
        .form-input:focus {
            outline: none;
            border-color: #647959;
            box-shadow: 0 0 0 3px rgba(100, 121, 89, 0.3);
        }
        .form-input::placeholder {
            color: #849b7a;
            opacity: 0.7;
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
        .user-status {
            background: rgba(164, 192, 154, 0.15);
            border: 1px solid rgba(164, 192, 154, 0.3);
        }
        .user-status-error {
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
            background: #4d5f43;
            border-radius: 50%;
            animation: twinkle 4s infinite ease-in-out;
        }
        
        .glowing-star {
            position: absolute;
            background: radial-gradient(circle, #647959, #4d5f43, transparent);
            border-radius: 50%;
            filter: blur(1px);
            animation: glow-pulse 3s infinite ease-in-out;
        }
        
        .shooting-star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: linear-gradient(45deg, transparent, #3e4c36, transparent);
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
    </style>
</head>
<body class="text-sage-100">
    <div class="stars-background" id="starsBackground"></div>
    
    <div class="container mx-auto px-4 py-8 max-w-6xl relative z-10">
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-sage-900 header-glow mb-2">User Management System</h1>
            <p class="text-sage-800 font-medium">Manage your application users with ease and precision</p>
        </header>
        
        <!-- Example container -->
        <div class="bg-sage-900 p-6 rounded-xl shadow-lg text-center text-sage-100">
            <p>This is your main content area.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starsBackground = document.getElementById('starsBackground');

            // Twinkling stars
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

            // Glowing stars
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

            // Shooting stars
            for (let i = 0; i < 6; i++) {
                const shootingStar = document.createElement('div');
                shootingStar.classList.add('shooting-star');
                shootingStar.style.left = `${Math.random() * 20}%`;
                shootingStar.style.top = `${Math.random() * 20}%`;
                shootingStar.style.animationDelay = `${Math.random() * 10}s`;
                starsBackground.appendChild(shootingStar);
            }
        });
    </script>
</body>
</html>
