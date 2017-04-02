<?php

    function getTitleSection($currentUrl) {
        switch ($currentUrl) {
            case route('dashboard.inicio'):
                return 'Inicio';
            case route('dashboard.routines'):
                return 'Rutinas';
            default:
                return 'Dashboard';
        }
    }