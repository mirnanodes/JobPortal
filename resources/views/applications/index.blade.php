<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Pelamar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <p class="text-lg font-medium text-gray-700">
                                Kelola daftar pelamar yang tersedia.
                            </p>

                            <form action="{{ route('applications.index') }}" method="GET">
                                <select name="job_id" onchange="this.form.submit()" class="border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm">
                                    <option value="">Semua Lowongan</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}" {{ request('job_id') == $job->id ? 'selected' : '' }}>
                                            {{ $job->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <form action="{{ route('applications.export') }}" method="GET">
                            <input type="hidden" name="job_id" value="{{ request('job_id') }}">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                Export ke Excel
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelamar</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lowongan</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CV</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($applications as $app)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $app->user->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $app->job->title }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('applications.downloadCV', $app->id) }}"
                                               class="inline-flex items-center px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-md hover:bg-purple-700">
                                                CV
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                $statusLower = strtolower($app->status);
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'interview' => 'bg-blue-100 text-blue-700',
                                                    'accepted' => 'bg-green-100 text-green-700',
                                                    'rejected' => 'bg-red-100 text-red-700'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium {{ $statusColors[$statusLower] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="flex gap-2">
                                                <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Accepted">
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-md hover:bg-green-700">
                                                        Terima
                                                    </button>
                                                </form>

                                                <form action="{{ route('applications.update', $app->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                            Belum ada pelamar yang daftar.
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
