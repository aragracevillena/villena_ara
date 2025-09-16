<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-200 via-pink-300 to-pink-400 flex items-center justify-center min-h-screen">

  <!-- Card -->
  <div class="bg-pink-100 shadow-xl rounded-2xl p-8 w-full max-w-md border border-pink-300">
    <h2 class="text-3xl font-bold text-center text-pink-800 mb-6">Create an Account</h2>

    <!-- ✅ Sign Up Form -->
    <form method="post" action="<?= site_url('users/create'); ?>" class="space-y-5">

      <!-- Username -->
      <div>
        <label for="username" class="block text-pink-900 mb-2 font-medium">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required
               class="w-full px-4 py-2 border border-pink-400 rounded-lg bg-pink-50 text-pink-900 
                      focus:ring-2 focus:ring-pink-500 focus:border-pink-600 outline-none transition">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-pink-900 mb-2 font-medium">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required
               class="w-full px-4 py-2 border border-pink-400 rounded-lg bg-pink-50 text-pink-900 
                      focus:ring-2 focus:ring-pink-500 focus:border-pink-600 outline-none transition">
      </div>

      <!-- Submit -->
      <button type="submit" 
              class="w-full bg-pink-600 text-white py-3 rounded-lg font-semibold shadow-md 
                     hover:bg-pink-700 hover:shadow-lg transition">
        Sign Up
      </button>
    </form>
    
  </div>

</body>
</html>
