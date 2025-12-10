<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platform Rekrutmen Antigravity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="/" class="text-xl font-bold text-primary">Platform Rekrutmen Antigravity</a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.vacancies.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700">Vacancies (CRUD)</a>
                                    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700">Approvals</a>
                                    <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700">Reports</a>
                                @else
                                    <a href="{{ route('vacancies.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700">Vacancies</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <div class="ml-3 relative">
                                <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                                    @csrf
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 hover:text-gray-900">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
