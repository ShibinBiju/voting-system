<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cast Your Vote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    @endif
                    
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(auth()->user()->vote)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <h6 class="text-blue-800 font-semibold">You have already voted!</h6>
                            <p class="text-blue-700 text-sm">
                                You voted for: {{ auth()->user()->vote->candidate->name }}
                            </p>
                        </div>
                    @else
                        <form method="POST" action="{{ route('vote.store') }}" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label for="candidate_id" class="block text-sm font-medium text-gray-700">Select a Candidate</label>
                                <select name="candidate_id" id="candidate_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Choose a candidate...</option>
                                    @foreach($candidates as $candidate)
                                        <option value="{{ $candidate->id }}">
                                            {{ $candidate->name }} - {{ $candidate->position }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Submit Vote
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
