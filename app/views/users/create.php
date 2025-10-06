<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User - User Management System</title>
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
        .btn-secondary {
            background: linear-gradient(to right, #849b7a, #647959);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: linear-gradient(to right, #647959, #4d5f43);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(77, 95, 67, 0.25);
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
        
        /* Darker Stars on Light Background */
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
            0%, 100% { 
                opacity: 0.2; 
                transform: scale(1);
            }
            50% { 
                opacity: 0.6; 
                transform: scale(1.2);
            }
        }
        
        @keyframes glow-pulse {
            0%, 100% { 
                opacity: 0.3; 
                transform: scale(1);
                filter: blur(1px) brightness(1);
            }
            50% { 
                opacity: 0.7; 
                transform: scale(1.3);
                filter: blur(2px) brightness(1.3);
            }
        }
        
        @keyframes shoot {
            0% {
                transform: translateX(-100px) translateY(-100px) rotate(45deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            100% {
                transform: translateX(100vw) translateY(100vh) rotate(45deg);
                opacity: 0;
            }
        }
        
        /* Glowing Border Effect */
        .glow-border {
            position: relative;
            background: #2b3327;
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
                #647959, 
                #849b7a, 
                #aec0a6, 
                #849b7a, 
                #647959);
            border-radius: 18px;
            z-index: -1;
            filter: blur(12px);
            opacity: 0.8;
            animation: border-glow 3s ease-in-out infinite alternate;
        }
        
        @keyframes border-glow {
            0% {
                opacity: 0.6;
                filter: blur(12px) brightness(1);
            }
            50% {
                opacity: 0.9;
                filter: blur(15px) brightness(1.3);
            }
            100% {
                opacity: 0.7;
                filter: blur(12px) brightness(1.1);
            }
        }
        
        /* Button glow effect */
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
<body class="text-sage-100">
    <!-- Darker Stars on Light Background -->
    <div class="stars-background" id="starsBackground"></div>
    
    <div class="container mx-auto px-4 py-8 max-w-4xl relative z-10">
        <!-- Header with Darker Text -->
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-sage-900 header-glow mb-2">User Management System</h1>
            <p class="text-sage-800 font-medium">Create a new user account</p>
        </header>

        <!-- Main Content Card with Glowing Border -->
        <div class="glow-border card-shadow rounded-xl overflow-hidden border border-sage-700">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-sage-700 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-sage-100">
                    <i class="fas fa-user-plus mr-2 text-sage-400"></i>Create New User
                </h2>
                <a href="<?= site_url('/users'); ?>"
                   class="btn-secondary text-white px-4 py-2 rounded-lg flex items-center space-x-2 action-btn glow-button">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Users</span>
                </a>
            </div>
            
            <!-- Form Content -->
            <div class="p-6">
                <form action="<?= site_url('/users/create'); ?>" method="POST" class="space-y-6">
                    <!-- Username Field -->
                    <div>
                        <label class="block text-sage-200 mb-2 font-medium">
                            <i class="fas fa-user mr-2 text-sage-400"></i>Username
                        </label>
                        <input 
                            type="text" 
                            name="username" 
                            placeholder="Enter username" 
                            required
                            class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-sage-400"
                        >
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sage-200 mb-2 font-medium">
                            <i class="fas fa-envelope mr-2 text-sage-400"></i>Email
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="Enter email address" 
                            required
                            class="form-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-sage-400"
                        >
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="<?= site_url('/index.php/users'); ?>" 
                           class="px-5 py-2.5 rounded-lg border border-sage-700 text-sage-300 bg-sage-800 hover:bg-sage-700 transition action-btn">
                            <i class="fas fa-times mr-1.5"></i> Cancel
                        </a>
                        <button type="submit" 
                                class="btn-primary glow-button text-white px-5 py-2.5 rounded-lg flex items-center space-x-2 action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>Create User</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create darker stars on light background
            const starsBackground = document.getElementById('starsBackground');
            
            // Create regular twinkling stars (darker colors)
            for (let i = 0; i < 120; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                // Random size and position
                const size = Math.random() * 2 + 1;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                
                // Random animation delay
                star.style.animationDelay = `${Math.random() * 4}s`;
                
                starsBackground.appendChild(star);
            }
            
            // Create glowing stars (darker colors)
            for (let i = 0; i < 40; i++) {
                const glowingStar = document.createElement('div');
                glowingStar.classList.add('glowing-star');
                
                // Random size and position
                const size = Math.random() * 4 + 2;
                glowingStar.style.width = `${size}px`;
                glowingStar.style.height = `${size}px`;
                glowingStar.style.left = `${Math.random() * 100}%`;
                glowingStar.style.top = `${Math.random() * 100}%`;
                
                // Random animation delay
                glowingStar.style.animationDelay = `${Math.random() * 3}s`;
                
                starsBackground.appendChild(glowingStar);
            }
            
            // Create shooting stars (darker colors)
            for (let i = 0; i < 6; i++) {
                const shootingStar = document.createElement('div');
                shootingStar.classList.add('shooting-star');
                
                // Random position and animation delay
                shootingStar.style.left = `${Math.random() * 20}%`;
                shootingStar.style.top = `${Math.random() * 20}%`;
                shootingStar.style.animationDelay = `${Math.random() * 10}s`;
                
                starsBackground.appendChild(shootingStar);
            }
        });
    </script>
</body>
</html>