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

if (! function_exists('currentAuth')) {
    /**
     * @return bool|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function currentAuth() {
        $guard = null;
        if (isAdmin()) {
            $guard = 'admin';
        } else if (isClient()) {
            $guard = 'client';
        } else if(isInstructor()) {
            $guard = 'instructor';
        }
        //$guard = isAdmin() ? 'admin' : isInstructor() ? 'instructor' : isClient() ? 'client' : null;
        if (is_null($guard)) {
            return false;
        }
        return Auth::guard($guard)->user();
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

function getTimeDiff($dtime,$atime)
{
    $nextDay = $dtime > $atime ? 1 : 0;
    $dep = explode(':', $dtime);
    $arr = explode(':', $atime);
    $diff = abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));
    $hours = floor($diff / (60 * 60));
    $mins = floor(($diff - ($hours * 60 * 60)) / (60));
    $secs = floor(($diff - (($hours*60*60)+($mins*60))));
    if(strlen($hours) < 2){
        $hours = "0" . $hours;
    }
    if(strlen($mins) < 2){
        $mins="0".$mins;
    }
    if(strlen($secs) < 2){
        $secs="0".$secs;
    }
    return $hours.':'.$mins.':'.$secs;
}

function getHoursDiff($from, $to) {
    if (! $from || ! $to) {
        return 0;
    }
    $diff = getTimeDiff($from, $to);
    $diffArr = explode(':', $diff);
    $hours = (int) $diffArr[0];
    return $hours;
}

if (! function_exists('formatTime')) {
    function formatTime($time) {
        $timeArr = explode(':', $time);
        array_pop($timeArr);
        $timeFormatted = implode(':', $timeArr);
        return $timeFormatted;
    }
}
