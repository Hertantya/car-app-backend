@extends('admin.layouts.app')

@section('title', 'Reports')

@section('content')

@if ($reports->isEmpty())
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 px-6 py-16 text-center">
        <p class="text-gray-400 text-sm">No data yet. Reports will appear once users start liking cars.</p>
    </div>
@else
    <div class="space-y-4">
        @foreach ($reports as $report)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- User header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $report['user']->name }}</p>
                        <p class="text-xs text-gray-400">{{ $report['user']->email }}</p>
                    </div>
                    <a href="{{ route('admin.users.show', $report['user']) }}"
                       class="text-xs text-blue-600 hover:underline">
                        Full activity →
                    </a>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 divide-x divide-gray-100">
                    <div class="px-6 py-5 text-center">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-medium mb-2">Most liked brand</p>
                        @if ($report['topBrand'])
                            <p class="text-lg font-bold text-gray-900">{{ $report['topBrand']->brand }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $report['topBrand']->total }} likes</p>
                        @else
                            <p class="text-gray-300 text-lg">—</p>
                        @endif
                    </div>

                    <div class="px-6 py-5 text-center">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-medium mb-2">Most liked model</p>
                        @if ($report['topModel'])
                            <p class="text-lg font-bold text-gray-900">
                                {{ $report['topModel']->brand }} {{ $report['topModel']->model }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $report['topModel']->total }} likes</p>
                        @else
                            <p class="text-gray-300 text-lg">—</p>
                        @endif
                    </div>

                    <div class="px-6 py-5 text-center">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-medium mb-2">Most liked type</p>
                        @if ($report['topType'])
                            <p class="text-lg font-bold text-gray-900">{{ $report['topType']->type }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $report['topType']->total }} likes</p>
                        @else
                            <p class="text-gray-300 text-lg">—</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
