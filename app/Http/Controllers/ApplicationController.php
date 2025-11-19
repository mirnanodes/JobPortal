<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'job'])->latest()->get();
        return view('applications.index', compact('applications'));
    }

    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $existing = Application::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah melamar di lowongan ini');
        }

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'cv' => $cvPath,
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    public function update(Request $request, string $id)
    {
        $application = Application::findOrFail($id);

        $application->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pelamar berhasil diperbarui!');
    }

    public function export(Request $request)
    {
        $jobId = $request->job_id;
        return Excel::download(new ApplicationsExport($jobId), 'applications.xlsx');
    }
}
