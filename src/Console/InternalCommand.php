<?php

namespace Armxy\Queue\Console;

use Armxy\Queue\Jobs\InternalJob;
use Armxy\Queue\Models\Job;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InternalCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:internal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a queue from the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $item = Job::findOrFail($this->argument('job_id'));

        if ($delay = (int) $this->option('delay')) {
            sleep($delay);
        }

        $job = new InternalJob($this->laravel, $item);

        $job->fire();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('job_id', InputArgument::REQUIRED, 'The Job ID'),
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('delay', 'D', InputOption::VALUE_OPTIONAL, 'The delay in seconds', 0),
        );
    }
}
