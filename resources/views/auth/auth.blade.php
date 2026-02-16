<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Sign In</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            500: '#6366f1', // Indigo
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full antialiased text-gray-800">

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        
        <!-- Header / Logo Area -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-6">
            <!-- Optional: Replace SVG with your Logo -->
            <div class="mx-auto h-12 w-12 bg-brand-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-brand-500/30">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-gray-900">
                School Management System
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Please enter your details to access your account.
            </p>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-[480px]">
            <!-- Card Container -->
            <div class="bg-white px-6 py-8 shadow-xl shadow-gray-200/50 sm:rounded-2xl sm:px-10 border border-gray-100">

                <!-- Alert: Global Errors or Success -->
                @if (session('status'))
                    <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-700 border border-green-100">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-700 border border-red-100">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Modern Tab Switcher -->
                <div class="bg-gray-100 p-1 rounded-xl flex justify-between items-center mb-8 relative">
                    <button onclick="switchTab('login')" id="tab-btn-login" 
                        class="w-1/2 text-sm font-medium py-2.5 rounded-lg shadow-sm bg-white text-gray-900 transition-all duration-200 focus:outline-none">
                        Sign In
                    </button>
                    <button onclick="switchTab('register')" id="tab-btn-register"
                        class="w-1/2 text-sm font-medium py-2.5 rounded-lg text-gray-500 hover:text-gray-700 transition-all duration-200 focus:outline-none">
                        Register
                    </button>
                </div>

                <!-- LOGIN FORM -->
                <div id="loginForm" class="block animate-fade-in-up">
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Email or phone -->
                        <label class="block text-sm font-semibold text-gray-700">Email or Phone</label>
                        <input name="login" type="text" required placeholder="you@example.com / 9876543210"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 sm:text-sm">


                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="login_password" class="block text-sm font-semibold text-gray-700">Password</label>
                                <a href="#" class="text-xs font-medium text-brand-600 hover:text-brand-500">Forgot password?</a>
                            </div>
                            <div class="mt-1">
                                <input id="login_password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Button -->
                        <div>
                            <button type="submit" 
                                class="flex w-full justify-center rounded-lg bg-brand-600 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all transform active:scale-[0.98]">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>

                <!-- REGISTER FORM -->
                <div id="registerForm" class="hidden animate-fade-in-up">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" autocomplete="name" required placeholder="John Doe"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="reg_email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                            <div class="mt-1">
                                <input id="reg_email" name="email" type="email" autocomplete="email" required placeholder="you@example.com"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                            <div class="mt-1">
                                <input id="phone" name="phone" type="text" required placeholder="+91 9876543210"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400">
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="reg_password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="reg_password" name="password" type="password" required placeholder="••••••••"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                            <div class="mt-1">
                                <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm placeholder-gray-400 transition-colors">
                            </div>
                        </div>

                        <!-- Button -->
                        <div>
                            <button type="submit" 
                                class="flex w-full justify-center rounded-lg bg-brand-600 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all transform active:scale-[0.98]">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
            
            {{-- <p class="mt-8 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} SaaS Platform. All rights reserved.
            </p> --}}
        </div>
    </div>

    <script>
        function switchTab(type) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginBtn = document.getElementById('tab-btn-login');
            const registerBtn = document.getElementById('tab-btn-register');

            // Active Class Styles (White bg, shadow, dark text)
            const activeClasses = ['bg-white', 'shadow-sm', 'text-gray-900'];
            // Inactive Class Styles (Transparent, gray text)
            const inactiveClasses = ['text-gray-500', 'hover:text-gray-700'];

            if (type === 'login') {
                // Show Login
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');

                // Style Buttons
                loginBtn.classList.add(...activeClasses);
                loginBtn.classList.remove(...inactiveClasses);
                
                registerBtn.classList.remove(...activeClasses);
                registerBtn.classList.add(...inactiveClasses);
            } else {
                // Show Register
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');

                // Style Buttons
                registerBtn.classList.add(...activeClasses);
                registerBtn.classList.remove(...inactiveClasses);

                loginBtn.classList.remove(...activeClasses);
                loginBtn.classList.add(...inactiveClasses);
            }
        }


        document.addEventListener("DOMContentLoaded", () => {
    let tab = "{{ session('tab') }}";

    if(tab === 'register') {
        switchTab('register');
    } else {
        switchTab('login');
    }
});




    </script>

</body>
</html>