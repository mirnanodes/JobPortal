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
                <h3 class="text-2xl font-bold mb-4">{{ $job->title }}</h3>

                <div class="mb-4">
                    @if ($job->logo)
                        <img src="{{ asset('storage/' . $job->logo) }}" class="w-32 h-32 object-contain mb-4">
                    @endif
                </div>

                <p class="text-gray-700 mb-2"><strong>Perusahaan:</strong> {{ $job->company }}</p>
                <p class="text-gray-700 mb-2"><strong>Lokasi:</strong> {{ $job->location }}</p>
                <p class="text-gray-700 mb-2"><strong>Jenis Pekerjaan:</strong> {{ $job->job_type }}</p>
                <p class="text-gray-700 mb-2"><strong>Gaji:</strong>
                    {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                </p>

                <p class="text-gray-700 mb-4 mt-4"><strong>Deskripsi:</strong><br>{{ $job->description }}</p>

                @auth
                    @if (Auth::user()->role === 'jobseeker')
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold mb-3">Lamar Sekarang</h4>
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
                @endauth

                <a href="{{ route('jobs.index') }}" class="text-blue-500 mt-4 block">← Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
