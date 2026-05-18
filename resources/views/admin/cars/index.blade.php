@extends('admin.layouts.app')

@section('title', 'Car Inventory')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('admin.cars.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
        + Add Car
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-800">All Cars</h3>
        <p class="text-sm text-gray-400 mt-0.5">{{ $cars->total() }} cars in the inventory</p>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Car</th>
                <th class="px-6 py-3 text-left">Type</th>
                <th class="px-6 py-3 text-center">Likes</th>
                <th class="px-6 py-3 text-center">Skips</th>
                <th class="px-6 py-3 text-center">Status</th>
                <th class="px-6 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($cars as $car)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if ($car->image_url)
                                <img src="{{ $car->image_url }}"
                                     alt="{{ $car->brand }} {{ $car->model }}"
                                     class="w-12 h-9 object-cover rounded-md bg-gray-100">
                            @else
                                <div class="w-12 h-9 bg-gray-100 rounded-md flex items-center justify-center text-gray-300 text-xs">
                                    No img
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-900">{{ $car->brand }} {{ $car->model }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2 py-0.5 rounded-full">
                            {{ $car->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-green-600 font-semibold">{{ $car->likes_count }}</span>
                    </td>
                    <td class="px-6 py-4 text-center text-gray-400">
                        {{ $car->skips_count }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if ($car->is_active)
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Active
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                Hidden
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <form method="POST" action="{{ route('admin.cars.toggle', $car) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="text-xs font-medium
                                               {{ $car->is_active
                                                   ? 'text-red-500 hover:text-red-700'
                                                   : 'text-green-600 hover:text-green-700' }}">
                                    {{ $car->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.cars.destroy', $car) }}"
                                  onsubmit="return confirm('Delete {{ $car->brand }} {{ $car->model }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs font-medium text-gray-400 hover:text-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        No cars found. Run the seeder or add one above.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($cars->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $cars->links() }}
        </div>
    @endif
</div>

@endsection
