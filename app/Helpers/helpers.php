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