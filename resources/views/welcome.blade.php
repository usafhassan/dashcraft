<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DashCraft') }} - Filament Expertise Showcase</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-white dark:bg-slate-900">
        <!-- Professional Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-white/90 dark:bg-slate-900/90 border-b border-slate-200/50 dark:border-slate-700/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                                Dash<span class="text-emerald-600 dark:text-emerald-400">Craft</span>
                            </h1>
                        </div>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors duration-200">Features</a>
                        <a href="#pricing" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors duration-200">Pricing</a>
                        <a href="#docs" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors duration-200">Docs</a>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white px-4 py-2 text-sm font-medium transition-colors duration-200">
                                    Sign In
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center pt-20 bg-gradient-to-br from-slate-50 via-white to-emerald-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Content -->
                    <div class="space-y-8">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Advanced Filament Development Showcase
                        </div>
                        
                        <!-- Main Heading -->
                        <div class="space-y-6">
                            <h1 class="text-5xl md:text-6xl font-bold text-slate-900 dark:text-white leading-tight">
                                Advanced
                                <span class="block text-emerald-600 dark:text-emerald-400">Filament Development</span>
                            </h1>
                            <p class="text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                                A comprehensive showcase of sophisticated Filament admin panels, custom resources, widgets, and enterprise-grade features built with Laravel 12 and Filament 4.
                            </p>
                        </div>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ url('/admin') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                Explore Filament Admin
                            </a>
                            <a href="https://github.com/usafhassan/dashcraft" class="border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:border-emerald-600 hover:text-emerald-600 dark:hover:text-emerald-400 px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-200 hover:bg-emerald-50 dark:hover:bg-emerald-900/10">
                                View Source Code
                            </a>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="flex items-center space-x-8 pt-8">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-slate-900 dark:text-white">Filament 4</div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">Latest Version</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-slate-900 dark:text-white">Laravel 12</div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">Framework</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-slate-900 dark:text-white">100%</div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">Open Source</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Visual -->
                    <div class="relative">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl p-8 border border-slate-200 dark:border-slate-700">
                            <div class="space-y-6">
                                <!-- Mock Dashboard Header -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-emerald-600 rounded-lg"></div>
                                        <span class="font-semibold text-slate-900 dark:text-white">Filament Admin</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                    </div>
                                </div>
                                
                                <!-- Mock Stats -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-slate-50 dark:bg-slate-700 rounded-lg p-4">
                                        <div class="text-2xl font-bold text-slate-900 dark:text-white">4</div>
                                        <div class="text-sm text-slate-600 dark:text-slate-400">Resources</div>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-700 rounded-lg p-4">
                                        <div class="text-2xl font-bold text-slate-900 dark:text-white">12</div>
                                        <div class="text-sm text-slate-600 dark:text-slate-400">Widgets</div>
                                    </div>
                                </div>
                                
                                <!-- Mock Chart -->
                                <div class="bg-slate-50 dark:bg-slate-700 rounded-lg p-4 h-32 flex items-end space-x-2">
                                    <div class="bg-emerald-500 h-16 w-8 rounded-t"></div>
                                    <div class="bg-emerald-400 h-20 w-8 rounded-t"></div>
                                    <div class="bg-emerald-500 h-12 w-8 rounded-t"></div>
                                    <div class="bg-emerald-400 h-24 w-8 rounded-t"></div>
                                    <div class="bg-emerald-500 h-18 w-8 rounded-t"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-emerald-500 rounded-full opacity-20"></div>
                        <div class="absolute -bottom-4 -left-4 w-12 h-12 bg-emerald-400 rounded-full opacity-20"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-gradient-to-br from-slate-50 to-white dark:from-slate-800 dark:to-slate-900">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-medium mb-6">
                        Features
                    </div>
                    <h2 class="text-5xl font-bold text-slate-900 dark:text-white mb-6">
                        Advanced Filament Features
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-300 max-w-3xl mx-auto">
                        Comprehensive demonstration of sophisticated Filament development capabilities and best practices.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group p-8 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Custom Resources</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            Sophisticated Filament resources with complex relationships, advanced filtering, and custom form schemas for enterprise applications.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group p-8 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Dashboard Widgets</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            Real-time Filament widgets with live data, interactive charts, and custom analytics for comprehensive business intelligence.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group p-8 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Filament Shield</h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                            Advanced role-based permissions with Filament Shield integration, granular access control, and secure resource management.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-32 bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 max-w-6xl mx-auto px-6 text-center">
                <div class="space-y-8">
                    <h2 class="text-5xl font-bold mb-6">
                        Explore Advanced Filament Development
                    </h2>
                    <p class="text-xl text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Discover sophisticated Filament admin panels, custom resources, and enterprise-grade features built with modern Laravel practices.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ url('/admin') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-10 py-4 rounded-lg text-lg font-semibold transition-all duration-200 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            Explore Admin Panel
                        </a>
                        <a href="https://github.com/usafhassan/dashcraft" class="border border-white/30 text-white px-10 py-4 rounded-lg text-lg font-semibold transition-all duration-200 hover:bg-white/10 hover:border-white">
                            View Source Code
                        </a>
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="flex items-center justify-center space-x-12 pt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-400">Filament 4</div>
                            <div class="text-sm text-slate-400">Latest Version</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-400">Laravel 12</div>
                            <div class="text-sm text-slate-400">Framework</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-emerald-400">100%</div>
                            <div class="text-sm text-slate-400">Open Source</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-white py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="space-y-6">
                        <h3 class="text-3xl font-bold">Dash<span class="text-emerald-400">Craft</span></h3>
                        <p class="text-slate-400 leading-relaxed">
                            Advanced Filament development showcase. Demonstrating sophisticated admin panels and enterprise-grade features.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <h4 class="font-bold text-xl text-white">Product</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="#features" class="hover:text-emerald-400 transition-colors duration-200">Features</a></li>
                            <li><a href="#pricing" class="hover:text-emerald-400 transition-colors duration-200">Pricing</a></li>
                            <li><a href="{{ url('/admin') }}" class="hover:text-emerald-400 transition-colors duration-200">Demo</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">API</a></li>
                        </ul>
                    </div>
                    
                    <div class="space-y-6">
                        <h4 class="font-bold text-xl text-white">Company</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">About</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Blog</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Careers</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="space-y-6">
                        <h4 class="font-bold text-xl text-white">Support</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Help Center</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Documentation</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Status</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-200">Security</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-slate-800 mt-16 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-slate-400">&copy; {{ date('Y') }} DashCraft. All rights reserved.</p>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-slate-400 hover:text-emerald-400 transition-colors duration-200">Privacy Policy</a>
                            <a href="#" class="text-slate-400 hover:text-emerald-400 transition-colors duration-200">Terms of Service</a>
                            <a href="#" class="text-slate-400 hover:text-emerald-400 transition-colors duration-200">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
