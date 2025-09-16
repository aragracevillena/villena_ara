<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-200 via-pink-300 to-pink-400 flex items-center justify-center min-h-screen">

  <!-- Card -->
  <div class="bg-pink-100 shadow-xl rounded-2xl p-8 w-full max-w-md border border-pink-300">
    <h2 class="text-3xl font-bold text-center text-pink-800 mb-6">Update Record</h2>

    <!-- ✅ Update Form -->
    <form action="<?= site_url('users/update/' . segment(4)); ?>" method="POST" class="space-y-5">

      <!-- Username -->
      <div>
        <label class="block text-pink-900 mb-2 font-medium">Username</label>
        <input type="text" id="username" name="username"  
               value="<?= html_escape($user['username']); ?>" required
               class="w-full px-4 py-2 border border-pink-400 rounded-lg bg-pink-50 text-pink-900 
                      focus:ring-2 focus:ring-pink-500 focus:border-pink-600 outline-none transition">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-pink-900 mb-2 font-medium">Email</label>
        <input type="email" name="email" 
               value="<?= html_escape($user['email']); ?>" required
               class="w-full px-4 py-2 border border-pink-400 rounded-lg bg-pink-50 text-pink-900 
                      focus:ring-2 focus:ring-pink-500 focus:border-pink-600 outline-none transition">
      </div>

      <!-- Submit -->
      <button type="submit" 
              class="w-full bg-pink-600 text-white py-3 rounded-lg font-semibold shadow-md 
                     hover:bg-pink-700 hover:shadow-lg transition">
        Update
      </button>
    </form>

  </div>

</body>
</html>
