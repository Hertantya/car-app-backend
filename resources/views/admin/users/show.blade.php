@extends('admin.layouts.app')

@section('title', $user->name . '\'s Activity')

@section('content')

{{-- Back link --}}
<a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">
    ← Back to users
</a>

{{-- User header --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-start justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
            <p class="text-gray-400 text-sm">{{ $user->email }}</p>
            <p class="text-gray-400 text-xs mt-1">Member since {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>

{{-- Stat summary cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Top Brand</p>
        <p class="text-xl font-bold text-gray-900">{{ $topBrand?->brand ?? '—' }}</p>
        @if ($topBrand)
            <p class="text-xs text-gray-400 mt-0.5">{{ $topBrand->total }} likes</p>
        @endif
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Top Model</p>
        <p class="text-xl font-bold text-gray-900">
            {{ $topModel ? $topModel->brand . ' ' . $topModel->model : '—' }}
        </p>
        @if ($topModel)
            <p class="text-xs text-gray-400 mt-0.5">{{ $topModel->total }} likes</p>
        @endif
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Top Type</p>
        <p class="text-xl font-bold text-gray-900">{{ $topType?->type ?? '—' }}</p>
        @if ($topType)
            <p class="text-xs text-gray-400 mt-0.5">{{ $topType->total }} likes</p>
        @endif
    </div>
</div>

{{-- Full swipe history --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h4 class="font-semibold text-gray-800">Swipe History</h4>
        <p class="text-xs text-gray-400 mt-0.5">{{ $preferences->total() }} total swipes</p>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Car</th>
                <th class="px-6 py-3 text-left">Brand</th>
                <th class="px-6 py-3 text-left">Type</th>
                <th class="px-6 py-3 text-center">Action</th>
                <th class="px-6 py-3 text-left">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($preferences as $pref)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-900">{{ $pref->car->brand }} {{ $pref->car->model }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $pref->car->brand }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $pref->car->type }}</td>
                    <td class="px-6 py-4 text-center">
                        @if ($pref->action === 'like')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700
                                         text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                ❤️ Like
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500
                                         text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                ✕ Skip
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-400 text-xs">
                        {{ $pref->created_at->format('d M Y, H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        This user has not swiped any cars yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($preferences->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $preferences->links() }}
        </div>
    @endif
</div>

@endsection
