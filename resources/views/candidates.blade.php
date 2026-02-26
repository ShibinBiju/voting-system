<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Candidates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($candidates->isEmpty())
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-blue-700">No candidates found.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($candidates as $candidate)
                                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                                    <div class="text-center">
                                        <div class="w-20 h-20 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                                            <span class="text-2xl font-bold text-blue-600">
                                                {{ strtoupper(substr($candidate->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $candidate->name }}</h3>
                                        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium inline-block mb-3">
                                            {{ $candidate->position }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <p class="mb-1">Candidate ID: {{ $candidate->id }}</p>
                                      
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8 text-center">
                            <div class="bg-gray-50 rounded-lg p-4 inline-block">
                                <h5 class="text-sm font-medium text-gray-500">Total Candidates</h5>
                                <h3 class="text-2xl font-bold text-blue-600">{{ $candidates->count() }}</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
