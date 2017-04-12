<?php

namespace App\Console\Commands;

use App\Models\Administrator;
use Illuminate\Console\Command;

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
        $phone = $this->ask('Indica el numero de telefono del super admin');
        $pass = $this->secret('Escribe el password para el super admin (minimo 6 caracteres)');
        $data = [
            'name' => 'super',
            'first_surname' => 'admin',
            'second_surname' => null,
            'phone_number' => $phone,
            'profile_picture' => null,
            'email' => $email,
            'password' => bcrypt($pass)
        ];
        Administrator::create($data);
        $this->comment('Se ha inicializado al administrador principal exitosamente');
    }
}
