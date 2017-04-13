<?php
    if (! function_exists('getUrls')) {
        /**
         * Retorna un array con el título de la sección asignado a cada ruta.
         *
         * @return array
         */
        function getUrls() {
            return [
                'Inicio'    =>  route('dashboard.inicio'),
                'Rutinas'   =>  route('dashboard.routines'),
                'Dietas'    =>  route('dashboard.diets'),
                'Progreso'  =>  route('dashboard.progress'),
                'Horario'   =>  route('dashboard.schedule'),
                'Instructor'=>  route('dashboard.instructor'),
                'Perfil'    =>  route('dashboard.profile'),
                'Ajustes'   =>  route('dashboard.settings')
            ];
        }
    }

    if (! function_exists('getTitleSection')) {
        /**
         * Retorna el título para la sección actual.
         *
         * @param String $currentUrl
         * @return string
         */
        function getTitleSection($currentUrl) {
            foreach (getUrls() as $title => $url) {
                if ($currentUrl == $url) {
                    return $title;
                }
            }
            return 'Dashboard';
        }
    }

    if (! function_exists('markAsActive')) {
        /**
         * Retorna  la clase de bootstrap 'active' si la url actual corresponde a la url dada.
         *
         * @param String $route
         * @return String
         */
        function markAsActive($route) {
            return url()->current() === $route ? 'active' : '';
        }
    }

    if (! function_exists('isAdmin')) {
        /**
         * Determina si el usuario actual es de tipo admin y está autenticado.
         *
         * @return bool
         */
        function isAdmin() {
            return Auth::guard('admin')->check();
        }
    }

    if (! function_exists('isClient')) {
        /**
         * Determina si el usuario actual es de tipo cliente y está autenticado.
         *
         * @return bool
         */
        function isClient() {
            return Auth::guard('client')->check();
        }
    }

if (! function_exists('isInstructor')) {
    /**
     * Determina si el usuario actual es de tipo instructor y está autenticado
     *
     * @return bool
     */
    function isInstructor() {
        return Auth::guard('instructor')->check();
    }
}

if (!function_exists('shouldIncludeNavbar')) {
    /**
     * @return bool
     */
    function shouldIncludeNavbar() {
        return url()->current() != url('/') && url()->current() != route('admin.login');
    }
}

if (! function_exists('getCurrentAuth')) {
    /**
     * Obtiene la instancia del usuario autenticado actual.
     *
     * @param string $guard
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function getCurrentAuth($guard) {
        return Auth::guard($guard)->user();
    }
}

if (! function_exists('authClient')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function authClient() {
        return getCurrentAuth('client');
    }
}

if (! function_exists('authAdmin')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function authAdmin() {
        return getCurrentAuth('admin');
    }
}

if (! function_exists('authInstructor')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function authInstructor() {
        return getCurrentAuth('instructor');
    }
}

if (! function_exists('clientsInstructor')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function clientsInstructor() {
        return getCurrentAuth('client')->instructor;
    }
}

if (! function_exists('getPP')) {
    /**
     * Obtiene la URL hacia la foto de perfil del usuario dado.
     *
     * @param $user
     *
     * @return string
     */
    function getPP($user) {
        return $user->profile_picture ?? '/imgs/profile_pic/default.jpg';
    }
}