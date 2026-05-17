@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Stats cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Total Users</p>
        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUsers }}</p>
        <p class="text-xs text-gray-400 mt-2">Mobile app accounts</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Total Cars</p>
        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalCars }}</p>
        <p class="text-xs text-gray-400 mt-2">In the inventory</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Total Likes</p>
        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalLikes }}</p>
        <p class="text-xs text-gray-400 mt-2">Swipes right across all users</p>
    </div>
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 font-medium">Total Skips</p>
        <p class="text-3xl font-bold text-gray-400 mt-1">{{ $totalSkips }}</p>
        <p class="text-xs text-gray-400 mt-2">Swipes left across all users</p>
    </div>
</div>

{{-- Recent users --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-semibold text-gray-800">Recent Users</h3>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:underline">
            View all →
        </a>
    </div>
    <div class="divide-y divide-gray-50">
        @forelse ($recentUsers as $user)
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.users.show', $user) }}"
                       class="text-xs text-blue-600 hover:underline">View</a>
                </div>
            </div>
        @empty
            <div class="px-6 py-8 text-center text-sm text-gray-400">
                No users yet. They will appear once people register on the mobile app.
            </div>
        @endforelse
    </div>
</div>

@endsection
