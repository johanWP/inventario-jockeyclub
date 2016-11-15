<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Phone;

class ImportAvaya extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phone = Phone::firstOrNew(['number' => $this->data[0]]);
        $phone->place = $this->data[4];
        $phone->save();
    }
}
