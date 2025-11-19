<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\JobsImport;
use Maatwebsite\Excel\Facades\Excel;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobVacancy::latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'job_type' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        JobVacancy::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
            'logo' => $logoPath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    public function edit(string $id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, string $id)
    {
        $job = JobVacancy::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'job_type' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = $job->logo;

        if ($request->hasFile('logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
            'logo' => $logoPath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $job = JobVacancy::findOrFail($id);

        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new JobsImport, $request->file('file'));
            return back()->with('success', 'Data lowongan berhasil diimport');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }
}
