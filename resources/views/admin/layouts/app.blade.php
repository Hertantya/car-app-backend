<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Car App Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Sidebar --}}
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0">
            <div class="px-6 py-5 border-b border-gray-700">
                <h1 class="text-xl font-bold tracking-tight">🚗 Car App</h1>
                <p class="text-gray-400 text-xs mt-1">Admin Dashboard</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Users
                </a>

                <a href="{{ route('admin.cars.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('admin.cars.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 17a4 4 0 01-4-4V5a2 2 0 012-2h12a2 2 0 012 2v8a4 4 0 01-4 4H8z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 17h12"/>
                    </svg>
                    Car Inventory
                </a>

                <a href="{{ route('admin.reports.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Reports
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-gray-700">
                <p class="text-xs text-gray-400 mb-2">Signed in as</p>
                <p class="text-sm text-white font-medium">{{ auth()->user()->name }}</p>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                    @csrf
                    <button type="submit"
                            class="w-full text-left text-sm text-red-400 hover:text-red-300 transition">
                        Sign out →
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 overflow-y-auto">
            {{-- Top bar --}}
            <div class="bg-white border-b px-8 py-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <span class="text-sm text-gray-500">{{ now()->format('D, d M Y') }}</span>
            </div>

            {{-- Flash messages --}}
            <div class="px-8 pt-4">
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Page content --}}
            <div class="px-8 py-6">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
