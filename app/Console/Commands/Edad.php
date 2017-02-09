<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class Edad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:edad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'COMANDO DE EDAD';

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
    public function handle()
    {
        $resultado =DB::select('select edad,id from edad where estado=1');

        foreach( $resultado as $result ) {
            $actua= DB::table('edad')->where('id', $result->id)->update(['edad' => $result->edad+1]);
        }
    }
}
