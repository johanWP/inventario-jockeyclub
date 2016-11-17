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
    protected $location;

    /**
     * ImportAvaya constructor.
     * @param $data Array de datos que viene del archivo .CVS
     * @param $location String que se escribe en el textbox
     */
    public function __construct($data, $location)
    {
        $this->data = $data;
        $this->location = $location;
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
        $phone->location = $this->location;
        $phone->save();
    }
}
