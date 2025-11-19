<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Lowongan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-start gap-6 mb-6">
                    <div class="w-24 h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 flex-shrink-0">
                        @if ($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold mb-4">{{ $job->title }}</h3>
                        <p class="text-gray-700 mb-2"><strong>Perusahaan:</strong> {{ $job->company }}</p>
                        <p class="text-gray-700 mb-2"><strong>Lokasi:</strong> {{ $job->location }}</p>
                        <p class="text-gray-700 mb-2"><strong>Jenis Pekerjaan:</strong> {{ $job->job_type }}</p>
                        <p class="text-gray-700 mb-2"><strong>Gaji:</strong>
                            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <p class="text-gray-700"><strong>Deskripsi:</strong></p>
                    <p class="text-gray-700 mt-2 whitespace-pre-line">{{ $job->description }}</p>
                </div>

                @auth
                    @if (Auth::user()->role === 'jobseeker')
                        @php
                            $hasApplied = \App\Models\Application::where('job_id', $job->id)
                                ->where('user_id', Auth::id())
                                ->exists();
                        @endphp

                        @if ($hasApplied)
                            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-blue-700 font-semibold">Anda sudah melamar untuk lowongan ini.</p>
                            </div>
                        @else
                            <div class="mt-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
                                <h4 class="font-semibold mb-3 text-purple-900">Upload CV</h4>
                                <form action="{{ route('apply.store', $job->id) }}"
                                      method="POST"
                                      enctype="multipart/form-data"
                                      class="space-y-3">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload CV (PDF):</label>
                                        <input type="file"
                                               name="cv"
                                               accept=".pdf"
                                               required
                                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white p-2">
                                    </div>

                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                        Lamar Sekarang
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif
                @endauth

                <a href="{{ route('jobs.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mt-4">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
