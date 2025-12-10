@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Create Vacancy</h2>
    
    <form action="{{ route('admin.vacancies.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                <select name="department_id" id="department_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="posisi" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" name="posisi" id="posisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>
            
            <div>
                <label for="quota" class="block text-sm font-medium text-gray-700">Quota</label>
                <input type="number" name="quota" id="quota" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Vacancy
                </button>
                <a href="{{ route('admin.vacancies.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
