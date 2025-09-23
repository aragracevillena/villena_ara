<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-200 via-pink-300 to-pink-400 flex items-center justify-center min-h-screen">
    <div class="bg-pink-100 shadow-xl rounded-2xl p-6 w-full max-w-5xl border border-pink-300 flex flex-col">
        <h1 class="text-3xl font-bold text-center text-pink-800 mb-6">Welcome to Index View</h1>

        <!-- Search Bar -->
<form method="get" action="<?=site_url()?>" class="search-bar">
  <input 
    type="text" 
    name="q" 
    value="<?=html_escape($_GET['q'] ?? '')?>" 
    placeholder="Search student..." 
    class="search-input">
  <button type="submit" class="search-btn">
    <i class="fa fa-search"></i>
  </button>
</form>

        <!-- Table -->
        <div class="overflow-x-auto mb-6">
            <table class="w-full border border-pink-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-pink-600 text-white">
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Username</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-200">
                    <?php foreach(html_escape($users) as $user): ?>
                    <tr class="hover:bg-pink-50 transition">
                        <td class="px-4 py-3 text-pink-900"><?= $user['id']; ?></td>
                        <td class="px-4 py-3 font-medium text-pink-900"><?= $user['username']; ?></td>
                        <td class="px-4 py-3 text-pink-800"><?= $user['email']; ?></td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="<?= site_url('users/update/'.$user['id']);?>" class="text-pink-700 hover:text-pink-900 font-semibold">Update</a> | 
                            <a href="<?= site_url('users/delete/'.$user['id']);?>" class="text-red-700 hover:text-red-900 font-semibold">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
<div class="mt-4 flex justify-center">
  <div class="pagination flex space-x-2">
      <?=$page ?? ''?>
  </div>
</div>

        <!-- Create Record Button Centered at Bottom -->
        <div class="flex justify-center">
            <a href="<?= site_url('/users/create'); ?>" class="bg-pink-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-pink-700 transition transform hover:scale-105">
                + Create Record
            </a>
        </div>
    </div>
</body>
</html>
