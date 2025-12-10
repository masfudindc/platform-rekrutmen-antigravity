@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow overflow-hidden sm:rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Apply for {{ $vacancy->posisi }}</h2>
    
    <form action="{{ route('applications.store', $vacancy) }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', auth()->user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>
            
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" required>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Application
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
