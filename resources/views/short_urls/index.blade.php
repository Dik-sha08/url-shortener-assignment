<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Short URLs') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Create form (sirf Sales/Manager ke liye enable hoga policy ke through) --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="POST" action="{{ route('short-urls.store') }}">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Original URL
                        </label>
                        <input type="text" name="original_url" class="w-full border rounded px-3 py-2"
                               placeholder="https://example.com" required>
                        @error('original_url')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded">
                        Create Short URL
                    </button>
                </form>
            </div>

            {{-- Listing --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Available Short URLs</h3>

                @if ($shortUrls->isEmpty())
                    <p class="text-gray-500 text-sm">No short URLs to display.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr>
                                <th class="pb-2">Code</th>
                                <th class="pb-2">Original URL</th>
                                <th class="pb-2">Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shortUrls as $url)
                                <tr class="border-t">
                                    <td class="py-2">{{ $url->short_code }}</td>
                                    <td class="py-2">
                                        <a href="{{ $url->original_url }}" target="_blank" class="text-blue-600 underline">
                                            {{ $url->original_url }}
                                        </a>
                                    </td>
                                    <td class="py-2">{{ $url->user->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
