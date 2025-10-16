<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      /* @theme {
        --color-clifford: #da373d; */
        @layer utilities {
          .bg-Orange-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(249 115 22 / var(--tw-bg-opacity));
          }
        }
    </style>
</head>
<body>
    <h1 class=" text-4xl font-bold text-center mt-10 mb-5 bg-Orange-500 text-white p-5">Teacher Dashboard</h1>Welcome to Teacher Dashboard</h1>
<p>Welcome, {{ auth('teacher')->user()->name }}</p>
<form method="POST" action="{{ route('teacher.logout') }}">
@csrf
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded p-6 ml-10" type="submit">Logout</button>
</form>
</body>
</html>
