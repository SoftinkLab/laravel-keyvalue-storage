<?php

namespace SoftinkLab\LaravelKeyvalueStorage\Console;

use Illuminate\Console\Command;
use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;

class KeyValueDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kvoption:delete {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a key-value pair in Key Value Storage';

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
     * @param  \App\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        KVOption::remove($this->argument('key'));
        $this->info('Key removed from the storage!');
    }
}