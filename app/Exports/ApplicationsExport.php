<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    protected $jobId;

    public function __construct($jobId = null)
    {
        $this->jobId = $jobId;
    }

    public function collection()
    {
        $query = Application::with(['user', 'job']);

        if ($this->jobId) {
            $query->where('job_id', $this->jobId);
        }

        return $query->get()->map(function ($app) {
            return [
                'Nama Pelamar' => $app->user->name ?? '-',
                'Lowongan' => $app->job->title ?? '-',
                'CV' => asset('storage/' . $app->cv),
                'Status' => $app->status,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Pelamar', 'Lowongan', 'CV', 'Status'];
    }
}
