<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'red' : 'blue' }} ml-2">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role === 'admin')
                        <!-- Admin Dashboard -->
                        <h5 class="mb-4 text-lg font-semibold">Admin Panel</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-blue-200 rounded-lg p-4 text-center">
                                <h6 class="font-semibold text-blue-800">View Results</h6>
                                <p class="text-gray-600 text-sm mt-1">See current voting statistics</p>
                                <a href="{{ route('admin.results') }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    View Results
                                </a>
                            </div>
                            <div class="border border-green-200 rounded-lg p-4 text-center">
                                <h6 class="font-semibold text-green-800">Manage Candidates</h6>
                                <p class="text-gray-600 text-sm mt-1">Add or edit candidates</p>
                                <a href="{{ route('admin.candidates.index') }}" class="inline-block mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Manage Candidates
                                </a>
                            </div>
                        </div>
                        
                    @else
                        <!-- Voter Dashboard -->
                        <h5 class="mb-4 text-lg font-semibold">Voting Panel</h5>
                        
                        @if(auth()->user()->vote)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <h6 class="text-green-800 font-semibold">Vote Submitted!</h6>
                                <p class="text-green-700 text-sm">
                                    You have successfully voted for <strong>{{ auth()->user()->vote->candidate->name }}</strong>.
                                </p>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <h6 class="text-blue-800 font-semibold">Ready to Vote?</h6>
                                <p class="text-blue-700 text-sm">
                                    You haven't voted yet. Click the button below to cast your vote!
                                </p>
                            </div>
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-blue-200 rounded-lg p-4 text-center">
                                <h6 class="font-semibold text-blue-800">Cast Your Vote</h6>
                                <p class="text-gray-600 text-sm mt-1">Choose your preferred candidate</p>
                                <a href="{{ route('vote.index') }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded {{ auth()->user()->vote ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-700' }}">
                                    {{ auth()->user()->vote ? 'Already Voted' : 'Vote Now' }}
                                </a>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 text-center">
                                <h6 class="font-semibold text-gray-800">View Candidates</h6>
                                <p class="text-gray-600 text-sm mt-1">See all available candidates</p>
                                <a href="{{ route('candidates.index') }}" class="inline-block mt-3 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                    View Candidates
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Common Section -->
                    <hr class="my-6">
                    <div class="text-center text-sm text-gray-500">
                        Welcome, {{ auth()->user()->name }}! 
                        Last login: {{ auth()->user()->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
