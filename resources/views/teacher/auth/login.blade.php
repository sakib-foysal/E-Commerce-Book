
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Teacher Login</title>
  <!-- Tailwind CDN for quick preview; remove if using project build (npm run dev) -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
  <div class="w-full max-w-md">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <div class="px-6 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 text-center mb-4">Teacher Login</h1>

        @if(session('status'))
          <div class="mb-4 text-sm text-green-700 bg-green-100 rounded px-3 py-2">{{ session('status') }}</div>
        @endif

        @if(session('error'))
          <div class="mb-4 text-sm text-red-700 bg-red-100 rounded px-3 py-2">{{ session('error') }}</div>
        @endif

        @if($errors->any())
          <div class="mb-4">
            <ul class="text-sm text-red-600 space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('teacher.login') }}" class="space-y-5">
          @csrf

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                   placeholder="you@example.com">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                   placeholder="••••••••">
          </div>

          <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center">
              <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
              <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            @if (\Illuminate\Support\Facades\Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Forgot?</a>
            @else
              <a href="#" class="text-indigo-600 hover:underline">Forgot?</a>
            @endif
          </div>

          <div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
              Login as Teacher
            </button>
          </div>
        </form>

      </div>
      <div class="bg-gray-50 px-6 py-4 text-center text-sm text-gray-600">
        Don't have an account?
        @if (\Illuminate\Support\Facades\Route::has('teacher.register'))
          <a href="{{ route('teacher.register') }}" class="text-indigo-600 hover:underline">Register</a>
        @else
          <a href="#" class="text-indigo-600 hover:underline">Register</a>
        @endif
      </div>
    </div>
  </div>
</body>
</html>

