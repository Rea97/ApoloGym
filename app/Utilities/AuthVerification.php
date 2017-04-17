<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Auth;

trait AuthVerification
{
    /**
     * Retorna true si el usuario está autenticado y es de tipo Administrator.
     *
     * @return bool
     */
    protected function isAdmin()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Retorna true si el usuario está autenticado y es de tipo Client.
     *
     * @return bool
     */
    protected function isClient()
    {
        return Auth::guard('client')->check();
    }

    /**
     * Retorna true si el usuario está autenticado y es de tipo Instructor.
     *
     * @return bool
     */
    protected function isInstructor()
    {
        return Auth::guard('instructor')->check();
    }

}