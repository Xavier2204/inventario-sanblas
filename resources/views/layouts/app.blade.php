@php
    $layoutName = 'layouts.app-admin'; // valor por defecto

    if (auth()->check()) {
        if (auth()->user()->esBodeguero()) {
            $layoutName = 'layouts.app-bodega';
        } elseif (auth()->user()->esCocina()) {
            $layoutName = 'layouts.app-cocina';
        } elseif (auth()->user()->esAdmin()) {
            $layoutName = 'layouts.app-admin';
        }
    }
@endphp
@extends($layoutName)