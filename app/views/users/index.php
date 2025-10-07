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

        /* Table styling */
        .table-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(to right, #647959, #4d5f43);
            color: #f8faf7;
        }

        .table-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table-row:hover {
            background: rgba(164, 192, 154, 0.1);
        }

        .table-cell {
            color: #f8faf7;
            padding: 12px 16px;
        }
        /* Pagination styling */
        .pagination-links {
            display: flex;
            justify-content: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination-links a, 
        .pagination-links span {
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.1);
            color: #f8faf7;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            min-width: 40px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-links a:hover {
            background: #647959;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(100, 121, 89, 0.3);
        }

        .pagination-links .current {
            background: #647959;
            color: #f8faf7;
            font-weight: bold;
            border-color: #849b7a;
        }

        .pagination-links .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-links .disabled:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body class="text-sage-100">
    <!-- Darker Stars on Light Background -->
    <div class="stars-background" id="starsBackground"></div>
    
    <div class="container mx-auto px-4 py-8 max-w-6xl relative z-10">
        <!-- Header with Darker Text -->
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-sage-900 header-glow mb-2">User Management System</h1>
            <p class="text-sage-800 font-medium">Manage your application users with ease and precision</p>
        </header>

        <!-- Main Content Card with Glowing Border -->
        <div class="glow-border card-shadow rounded-xl overflow-hidden">
            <!-- Card Header with Dashboard Info -->
            <div class="px-6 py-4 border-b border-sage-700 flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-sage-100">
                        <i class="fas fa-users mr-2 text-sage-400"></i>
                        <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
                    </h2>
                </div>
                <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                    <!-- User Welcome -->
                    <?php if(!empty($logged_in_user)): ?>
                        <div class="user-status px-4 py-2 rounded-lg text-sage-300">
                            <i class="fas fa-user mr-2 text-sage-400"></i>
                            <strong>Welcome:</strong> <?= html_escape($logged_in_user['username']); ?>
                        </div>
                    <?php else: ?>
                        <div class="user-status-error px-4 py-2 rounded-lg text-red-300">
                            <i class="fas fa-exclamation-circle mr-2"></i>Logged in user not found
                        </div>
                    <?php endif; ?>
                    
                    <!-- Logout Button -->
                    <a href="<?=site_url('auth/logout'); ?>" 
                       class="btn-logout glow-button text-white px-5 py-2 rounded-lg flex items-center space-x-2 action-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>

            <!-- Search and Actions -->
            <div class="px-6 py-4 border-b border-sage-800 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <!-- Search Bar -->
                <form method="get" action="<?=site_url('users');?>" class="flex w-full sm:w-auto">
                    <div class="relative flex-grow">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-sage-600"></i>
                        </span>
                        <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                        <input 
                            type="text" 
                            name="q" 
                            value="<?= html_escape($q); ?>" 
                            placeholder="Search users..." 
                            class="form-input pl-10 pr-4 py-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-sage-400"
                        >
                    </div>
                    <button type="submit" 
                            class="ml-2 px-4 py-2 bg-sage-600 text-white rounded-lg hover:bg-sage-500 transition action-btn glow-button">
                        <i class="fas fa-search mr-1"></i> Search
                    </button>
                </form>

                <!-- Create User Button (Admin Only) -->
                <?php if ($logged_in_user['role'] === 'admin'): ?>
                <a href="<?= site_url('users/create'); ?>"
                   class="btn-primary glow-button text-white px-5 py-2 rounded-lg flex items-center space-x-2 action-btn">
                    <i class="fas fa-plus-circle"></i>
                    <span>Create New User</span>
                </a>
                <?php endif; ?>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto p-4">
                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr class="table-header">
                                <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                    <i class="fas fa-hashtag mr-1"></i>ID
                                </th>
                                <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                    <i class="fas fa-user mr-1"></i>Name
                                </th>
                                <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                    <i class="fas fa-envelope mr-1"></i>Email
                                </th>
                                <?php if ($logged_in_user['role'] === 'admin'): ?>
                                    <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                        <i class="fas fa-lock mr-1"></i>Password
                                    </th>
                                    <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                        <i class="fas fa-user-tag mr-1"></i>Role
                                    </th>
                                <?php endif; ?>
                                <th class="px-6 py-3 font-medium uppercase tracking-wider text-center">
                                    <i class="fas fa-cog mr-1"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($user)): ?>
                                <?php foreach ($user as $user_item): ?>
                                <tr class="table-row">
                                    <td class="table-cell text-center">
                                        <span class="bg-sage-800 px-3 py-1.5 rounded-lg text-sage-300 font-medium border border-sage-700">
                                            #<?= $user_item['id']; ?>
                                        </span>
                                    </td>
                                    <td class="table-cell text-center font-medium">
                                        <i class="fas fa-user-circle mr-2 text-sage-400"></i><?= html_escape($user_item['username']); ?>
                                    </td>
                                    <td class="table-cell text-center">
                                        <i class="fas fa-envelope mr-2 text-sage-400"></i><?= html_escape($user_item['email']); ?>
                                    </td>
                                    <?php if ($logged_in_user['role'] === 'admin'): ?>
                                        <td class="table-cell text-center">
                                            <i class="fas fa-lock mr-2 text-sage-400"></i>•••••••
                                        </td>
                                        <td class="table-cell text-center">
                                            <span class="bg-sage-800 px-3 py-1.5 rounded-lg text-sage-300 font-medium border border-sage-700">
                                                <?= html_escape($user_item['role']); ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                    <td class="table-cell text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="<?= site_url('/users/update/'.$user_item['id']);?>" 
                                               class="btn-update glow-button px-4 py-2 rounded-lg text-white transition action-btn">
                                                <i class="fas fa-edit mr-1.5"></i> Update
                                            </a>
                                            <a href="<?= site_url('/users/delete/'.$user_item['id']);?>" 
                                               class="btn-danger glow-button px-4 py-2 rounded-lg text-white transition action-btn">
                                                <i class="fas fa-trash mr-1.5"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?= ($logged_in_user['role'] === 'admin') ? 6 : 4 ?>" class="table-cell text-center py-8">
                                        <i class="fas fa-users text-sage-400 text-4xl mb-4"></i>
                                        <p class="text-sage-300">No users found.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
                     </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-sage-800 bg-sage-800">
                <div class="flex justify-center items-center">
                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: nowrap; width: 100%;">
                        <?php echo $page; ?>
                    </div>
                </div>
            </div>
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