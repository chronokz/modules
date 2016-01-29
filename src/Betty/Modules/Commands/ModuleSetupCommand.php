<?php namespace Betty\Modules\Commands;

use Illuminate\Console\Command;

class ModuleSetupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setting up modules folders for first use.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->generateModulesFolder();

        $this->generateAssetsFolder();
    }

    /**
     * Generate the modules folder.
     */
    public function generateModulesFolder()
    {
        $this->generateDirectory($this->laravel['config']->get('modules::paths.modules'),
            'Modules directory created successfully',
            'Modules directory already exist'
        );
    }

    /**
     * Generate the assets folder.
     */
    public function generateAssetsFolder()
    {
        $this->generateDirectory($this->laravel['config']->get('modules::paths.assets'),
            'Assets directory created successfully',
            'Assets directory already exist'
        );
    }

    /**
     * Generate the specified directory by given $dir.
     *
     * @param $dir
     * @param $success
     * @param $error
     */
    protected function generateDirectory($dir, $success, $error)
    {
        if ( ! $this->laravel['files']->isDirectory($dir))
        {
            $this->laravel['files']->makeDirectory($dir);

            $this->info($success);

            return;
        }

        $this->error($error);
    }
}
