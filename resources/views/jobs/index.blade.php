<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role === 'admin' ? 'Kelola Lowongan' : 'Daftar Lowongan' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @auth
                @if (Auth::user()->role === 'admin')
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Import Lowongan</h3>

                        <div class="mb-4">
                            <a href="{{ route('jobs.template') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Download Template Import
                            </a>
                        </div>

                        <form action="{{ route('jobs.import') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload File Excel (.xlsx)
                                </label>
                                <input type="file"
                                       name="file"
                                       accept=".xlsx,.xls,.csv"
                                       required
                                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none p-2">
                            </div>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Import Data
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <p class="text-lg font-medium text-gray-700">
                                {{ Auth::check() && Auth::user()->role === 'jobseeker' ? 'Cari Lowongan Kerja' : 'Kelola lowongan kerja yang tersedia' }}
                            </p>

                            @auth
                                @if (Auth::user()->role === 'jobseeker')
                                    <form action="{{ route('jobs.index') }}" method="GET">
                                        <select name="filter" onchange="this.form.submit()" class="border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm">
                                            <option value="">Semua Lowongan</option>
                                            <option value="full-time" {{ request('filter') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                            <option value="part-time" {{ request('filter') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                            <option value="contract" {{ request('filter') == 'contract' ? 'selected' : '' }}>Contract</option>
                                            <option value="freelance" {{ request('filter') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                        </select>
                                    </form>
                                @endif
                            @endauth
                        </div>

                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('jobs.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Tambah Lowongan
                                </a>
                            @endif
                        @endauth
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($jobs as $job)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->title }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $job->company }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $job->salary ? 'Rp ' . number_format($job->salary, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex gap-2">
                                                @auth
                                                    @if (Auth::user()->role === 'jobseeker')
                                                        <a href="{{ route('jobs.show', $job->id) }}"
                                                           class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-md hover:bg-blue-700">
                                                            Lihat Detail
                                                        </a>
                                                    @endif

                                                    @if (Auth::user()->role === 'admin')
                                                        <a href="{{ route('jobs.edit', $job->id) }}"
                                                           class="inline-flex items-center px-3 py-1 bg-orange-600 text-white text-xs font-semibold rounded-md hover:bg-orange-700">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('jobs.destroy', $job->id) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Yakin ingin menghapus?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                                            Belum ada lowongan yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
