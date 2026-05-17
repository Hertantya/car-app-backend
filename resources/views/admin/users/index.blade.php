@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-800">All Mobile Users</h3>
        <p class="text-sm text-gray-400 mt-0.5">{{ $users->total() }} registered accounts</p>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">User</th>
                <th class="px-6 py-3 text-center">Likes</th>
                <th class="px-6 py-3 text-center">Skips</th>
                <th class="px-6 py-3 text-center">Total swipes</th>
                <th class="px-6 py-3 text-left">Joined</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-gray-400 text-xs">{{ $user->email }}</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                            {{ $user->likes_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-0.5 rounded-full">
                            {{ $user->skips_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-600">
                        {{ $user->total_swipes }}
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-xs">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="text-blue-600 hover:underline text-xs font-medium">
                            View activity →
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        No users registered yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    @endif
</div>

@endsection
