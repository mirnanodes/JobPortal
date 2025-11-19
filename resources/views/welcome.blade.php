<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">
                Job Portal
            </h1>
            <p class="text-xl text-gray-600">
                Platform Lowongan Kerja Terpercaya
            </p>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">
                    Selamat Datang!
                </h2>
                <p class="text-gray-600 text-lg">
                    Temukan pekerjaan impian Anda atau kelola lowongan kerja dengan mudah
                </p>
            </div>

            <!-- Features -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="p-6 bg-blue-50 rounded-lg">
                    <div class="text-blue-600 text-3xl mb-3">👔</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Untuk Jobseeker</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>✓ Lihat lowongan kerja terbaru</li>
                        <li>✓ Upload CV dalam format PDF</li>
                        <li>✓ Pantau status lamaran</li>
                    </ul>
                </div>

                <div class="p-6 bg-green-50 rounded-lg">
                    <div class="text-green-600 text-3xl mb-3">🏢</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Untuk Admin</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>✓ Kelola lowongan kerja</li>
                        <li>✓ Export/Import data Excel</li>
                        <li>✓ Kelola pelamar</li>
                    </ul>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route('jobs.index') }}" 
                       class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white text-center font-semibold rounded-lg hover:bg-indigo-700 transition duration-200 shadow-md">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white text-center font-semibold rounded-lg hover:bg-indigo-700 transition duration-200 shadow-md">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="w-full sm:w-auto px-8 py-3 bg-white text-indigo-600 text-center font-semibold rounded-lg border-2 border-indigo-600 hover:bg-indigo-50 transition duration-200">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Demo Accounts -->
            <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="font-semibold text-gray-800 mb-2">🔑 Demo Accounts:</h4>
                <div class="grid md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="font-semibold text-gray-700">Admin:</p>
                        <p class="text-gray-600">Email: admin@jobportal.com</p>
                        <p class="text-gray-600">Password: password</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">Jobseeker:</p>
                        <p class="text-gray-600">Email: lila@example.com</p>
                        <p class="text-gray-600">Password: password</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-600">
            <p>© 2025 Job Portal - Ayu Mirnawati (24/534245/SV/24017)</p>
        </div>
    </div>
</body>
</html>