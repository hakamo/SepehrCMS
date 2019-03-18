<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
     //
     '/admin/imagebrowser/read',
     '/admin/imagebrowser/upload',
     '/public/admin/imagebrowser/upload',
     '/admin/imagebrowser/read/gallery',
     '/admin/imagebrowser/upload/gallery',

     '/admin/gallery/read/',
     '/admin/gallery/create/',
     '/admin/gallery/destroy/',
     '/admin/gallery/update/',
 ];
}
