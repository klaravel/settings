<?php namespace Klaravel\Settings\Commands;

use Illuminate\Console\Command;

/**
 * Create migration file for settings table
 */
class MigrationCommand extends Command
{
    /**
     * Selected profile for generate
     * 
     * @var string
     */
    private $profile;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'settings:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the Settings specifications.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->laravel->view->addNamespace('settings', __DIR__.'/../views');

        $this->line('');

        $this->info("Creating migration...");
        if ($this->createMigration()) {
            $this->info("Migration successfully created!");
        } else {
            $this->error(
                "Couldn't create migration.\n Check the write permissions".
                " within the database/migrations directory."
            );
        }

        $this->line('');
    }

    /**
     * Create the migration.
     *
     * @return bool
     */
    protected function createMigration()
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')
            ."_create_settings_table.php";

        $output = $this->laravel->view->make('settings::generators.migration')->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}