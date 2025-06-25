<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    Sản phẩm
                                </a>
                                @auth
                                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        Đơn hàng của tôi
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            Admin Panel
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            @auth
                                <div class="relative">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-700 mr-4">{{ Auth::user()->name }}</span>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700">Đăng nhập</a>
                                    <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-700">Đăng ký</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
        <!-- Toast Notification -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('success'))
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                @endif
                @if(session('error'))
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: '{{ session('error') }}',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                @endif
            });
        </script>
        <!-- Support Button for User -->
        @auth
            @if(auth()->user()->role === 'user')
                <button id="supportBtn" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-800 text-white rounded-full shadow-lg p-4 z-50 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 11-12.728 0M12 3v9"></path></svg>
                    Hỗ trợ
                </button>
                <script>
                    document.getElementById('supportBtn').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Hỗ trợ khách hàng',
                            html: '<b>Email:</b> support@example.com<br><b>Hotline:</b> 0123 456 789<br><br>Hoặc gửi yêu cầu hỗ trợ qua form bên dưới.',
                            icon: 'info',
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText: 'Đóng'
                        });
                    });
                </script>
            @endif
        @endauth
    </body>
</html>
