<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSystemPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-system-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание возможных пермишнов';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permissions = [
            'can_read_users',
            'can_create_events',
            'can_update_events',
            'can_delete_events',
        ];
        foreach ($permissions as $permission){
            \Spatie\Permission\Models\Permission::create(['name'=>$permission]);
        }
    }
}
