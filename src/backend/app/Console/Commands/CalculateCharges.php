<?php

namespace App\Console\Commands;

use App\Repositories\Frontend\DailyServiceRepository;
use App\TransactionActivity;
use Illuminate\Console\Command;

class CalculateCharges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:charges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DailyServiceRepository $dsrepo,TransactionActivity $trans)
    {
        $ds=$dsrepo->whereNull('end_date')->get();
        // dd($ds);
        foreach ($ds as $daily) {
            foreach ($daily->dummpyservices()->get() as $sg) {
                $transdata= [
                    'patient_id'=> $daily->patient_id,
                    'user_id'=> $sg->user_id,
                    'cmt'=> "Service ".$sg->service->name." Added",
                    'type'=> "-",
                    'amount'=> $sg->service->price,
                ];
                dump($transdata);
                $trans->create($transdata);
            }    
        }
    }
}
