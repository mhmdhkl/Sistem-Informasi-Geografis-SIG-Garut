<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIG Garut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">

            <div class="hidden md:flex w-1/2 items-center justify-center bg-blue-50 p-12">
                <img src="{{ asset('images/logo-garut.png') }}" alt="Logo Kabupaten Garut" class="max-w-xs">
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Masuk ke akun Anda</h2>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">Whoops! Ada yang salah.</div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Silakan masukkan alamat email Anda">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukkan kata sandi">
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Login
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>