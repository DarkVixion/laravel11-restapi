<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tindaklanjut;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MarkTindaklanjutOverdue extends Command
{
    // Command signature and description
    protected $signature = 'tindaklanjut:check-overdue';
    protected $description = 'Mark tindaklanjut as overdue if tanggal_akhir has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get current date and time
        $now = Carbon::now();

        // Find all tindaklanjut records where status is 'OnProcess' and tanggal_akhir is in the past
        $overdueTindaklanjuts = Tindaklanjut::where('status', 'OnProcess')
            ->where('tanggal_akhir', '<', $now)
            ->get();

        foreach ($overdueTindaklanjuts as $tindaklanjut) {
            try {
                // Update the status to 'Overdue'
                $tindaklanjut->status = 'Overdue';
                $tindaklanjut->save();

                // Log the change
                Log::info('Tindaklanjut ID ' . $tindaklanjut->id . ' marked as overdue.');

                // Inform in the console
                $this->info('Tindaklanjut ID ' . $tindaklanjut->id . ' marked as overdue.');
            } catch (\Exception $e) {
                // Log the error if save fails
                Log::error('Failed to update Tindaklanjut ID ' . $tindaklanjut->id . ': ' . $e->getMessage());

                // Inform in the console about the failure
                $this->error('Failed to update Tindaklanjut ID ' . $tindaklanjut->id . '.');
            }
        }

        return 0;
    }
}