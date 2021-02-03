<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud 
    {nameOfTheClass? : The name of the class.},
    {nameOfTheModelClass? : The name of the model class. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a custom livewire CRUD.';

    protected $nameOfTheClass;
    protected $nameOfTheModelClass;
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
     * @return int
     */
    public function handle()
    {
        // $this->info('This is your custom Livewire command for CRUD.');
        $this->gatheParameters();
    }

    protected function gatheParameters()
    {
        // $this->info($this->argument('nameOfTheClass'));
        // $this->info($this->argument('nameOfTheModelClass'));

        $this->nameOfTheClass = $this->argument('nameOfTheClass');
        $this->nameOfTheModelClass = $this->argument('nameOfTheModelClass');

        // if you didn't input the name of the class
        if (!$this->nameOfTheClass) {
            $this->nameOfTheClass = $this->ask('Enter class name.');
        }

        // if you didn't input the name of the class
        if (!$this->nameOfTheModelClass) {
            $this->nameOfTheModelClass = $this->ask('Enter model name.');
        }

        $this->info($this->nameOfTheClass . ' ' . $this->nameOfTheModelClass);
    }
}
