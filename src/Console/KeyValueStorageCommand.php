<?php

namespace SoftinkLab\LaravelKeyvalueStorage\Console;

use Illuminate\Console\Command;
use SoftinkLab\LaravelKeyvalueStorage\Facades\KVOption;

class KeyValueStorageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kvoption:create {key} {value} {--comment=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create/Update a key-value pair in Key Value Storage';

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
        KVOption::set($this->argument('key'), $this->argument('value'), $this->option('comment'));
        $this->info('Option storage updated!');
    }
}