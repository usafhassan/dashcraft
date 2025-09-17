<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Send Welcome Email Job
 * 
 * Demonstrates queued job implementation for background processing.
 * Sends welcome emails to new customers asynchronously.
 */
class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Customer $customer
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Sending welcome email to customer', [
                'customer_id' => $this->customer->id,
                'customer_email' => $this->customer->email,
                'customer_name' => $this->customer->name,
            ]);

            // In a real application, we would send an actual email here
            // For demo purposes, we'll just log the action
            $this->simulateEmailSending();

            Log::info('Welcome email sent successfully', [
                'customer_id' => $this->customer->id,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send welcome email', [
                'customer_id' => $this->customer->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Simulate email sending for demo purposes.
     */
    protected function simulateEmailSending(): void
    {
        // Simulate email processing time
        usleep(500000); // 0.5 seconds

        // In a real application, you would use Laravel's Mail facade:
        /*
        Mail::to($this->customer->email)
            ->send(new WelcomeEmail($this->customer));
        */
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Welcome email job failed permanently', [
            'customer_id' => $this->customer->id,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }

    /**
     * Get the tags that should be assigned to the job.
     */
    public function tags(): array
    {
        return [
            'customer:' . $this->customer->id,
            'email:welcome',
            'customer:' . $this->customer->classification,
        ];
    }
}