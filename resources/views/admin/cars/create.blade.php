@extends('admin.layouts.app')

@section('title', 'Add New Car')

@section('content')

<a href="{{ route('admin.cars.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">
    ← Back to inventory
</a>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-xl">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-800">Add New Car</h3>
    </div>

    <form method="POST" action="{{ route('admin.cars.store') }}" class="px-6 py-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
            <input type="text" name="brand" value="{{ old('brand') }}" required
                   placeholder="e.g. Toyota"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          @error('brand') border-red-400 @enderror">
            @error('brand')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
            <input type="text" name="model" value="{{ old('model') }}" required
                   placeholder="e.g. Supra"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          @error('model') border-red-400 @enderror">
            @error('model')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type / Category</label>
            <select name="type" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           @error('type') border-red-400 @enderror">
                <option value="">Select a type</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Image URL <span class="text-gray-400 font-normal">(optional)</span>
            </label>
            <input type="url" name="image_url" value="{{ old('image_url') }}"
                   placeholder="https://..."
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          @error('image_url') border-red-400 @enderror">
            @error('image_url')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-gray-300 text-blue-600">
            <label for="is_active" class="text-sm text-gray-700">
                Active (visible to mobile users)
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                           px-6 py-2.5 rounded-lg transition-colors">
                Add Car
            </button>
            <a href="{{ route('admin.cars.index') }}"
               class="text-gray-600 hover:text-gray-800 text-sm font-medium px-6 py-2.5 rounded-lg
                      border border-gray-300 hover:border-gray-400 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
