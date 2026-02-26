<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voting Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-lg font-semibold">Voting Results</h4>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            Total Votes: {{ $candidates->sum('votes_count') }}
                        </span>
                    </div>
                    
                    @if($candidates->isEmpty())
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-blue-700">No candidates found.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Votes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $totalVotes = $candidates->sum('votes_count');
                                    @endphp
                                    
                                    @foreach($candidates as $candidate)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $candidate->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $candidate->position }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                                    {{ $candidate->votes_count }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($totalVotes > 0)
                                                    {{ number_format(($candidate->votes_count / $totalVotes) * 100, 1) }}%
                                                @else
                                                    0%
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="w-full bg-gray-200 rounded-full h-4">
                                                    @if($totalVotes > 0)
                                                        <div class="bg-blue-600 h-4 rounded-full flex items-center justify-center text-xs text-white" 
                                                             style="width: {{ ($candidate->votes_count / $totalVotes) * 100 }}%">
                                                            @if(($candidate->votes_count / $totalVotes) * 100 > 20)
                                                                {{ $candidate->votes_count }}
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="bg-gray-400 h-4 rounded-full" style="width: 0%"></div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <h5 class="text-sm font-medium text-gray-500">Total Candidates</h5>
                                <h3 class="text-2xl font-bold text-blue-600">{{ $candidates->count() }}</h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <h5 class="text-sm font-medium text-gray-500">Total Votes</h5>
                                <h3 class="text-2xl font-bold text-green-600">{{ $totalVotes }}</h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <h5 class="text-sm font-medium text-gray-500">Leading</h5>
                                <h3 class="text-lg font-bold text-yellow-600">
                                    {{ $candidates->sortByDesc('votes_count')->first()->name ?? 'N/A' }}
                                </h3>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <h5 class="text-sm font-medium text-gray-500">Avg Votes</h5>
                                <h3 class="text-2xl font-bold text-purple-600">
                                    {{ $candidates->count() > 0 ? number_format($totalVotes / $candidates->count(), 1) : 0 }}
                                </h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
