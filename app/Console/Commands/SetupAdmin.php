<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SetupAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa el administrador principal del sitio';

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
     * @return void
     */
    public function handle()
    {
        $email = $this->ask('Indica el email del super admin');
        $pass = $this->secret('Escribe el password para el super admin (minimo 6 caracteres)');
        $data = [
            'name' => 'superadmin',
            'email' => $email,
            'password' => bcrypt($pass)
        ];
        User::create($data);
        $this->comment('Se ha inicializado al administrador principal exitosamente');
    }
}
