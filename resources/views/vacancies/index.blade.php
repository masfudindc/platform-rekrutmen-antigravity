@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Available Vacancies</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($vacancies as $vacancy)
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $vacancy->posisi }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $vacancy->department->name }} - Quota: {{ $vacancy->quota }}</p>
                    <p class="text-gray-700 mb-4 line-clamp-3">{{ $vacancy->deskripsi }}</p>
                    <div class="mt-4">
                        <a href="{{ route('vacancies.show', $vacancy) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                No vacancies available at the moment.
            </div>
        @endforelse
    </div>
</div>
@endsection
