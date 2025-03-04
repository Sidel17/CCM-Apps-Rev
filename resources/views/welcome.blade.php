<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCM-Apss</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #2921a8, #004ae8, #ff6300, #ffd800);
        }
        .glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gradient h-screen flex items-center justify-center">
    <div class="glass p-10 text-center max-w-lg w-full">
        <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
        <h1 class="text-4xl font-bold text-white mt-5">Welcome to CCM-Apps</h1>
        <p class="text-white mt-3">This is abang Taufiq Setya yang buat.</p>
        <a href="/login" class="mt-5 inline-block bg-white text-gray-800 px-5 py-2 rounded-lg shadow-md hover:bg-gray-200 transition">Enter</a>
    </div>
</body>
</html>
