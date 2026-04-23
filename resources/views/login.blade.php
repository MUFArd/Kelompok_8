<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-100">
  <div class="w-full max-w-sm mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h3 class="text-center text-blue-600 text-2xl font-semibold mb-4">Login</h3>
      <form action="" method="post" class="space-y-4">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
            <span class="inline-flex items-center gap-2">
              <i class="fa-solid fa-user text-gray-500"></i> Username
            </span>
          </label>
          <input type="text" id="username" name="username" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
            <span class="inline-flex items-center gap-2">
              <i class="fa-solid fa-lock text-gray-500"></i> Password
            </span>
        </label>
          <input type="password" id="password" name="password" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="flex justify-center">
          <button type="submit"
            class="w-1/2 bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">
            Masuk
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>