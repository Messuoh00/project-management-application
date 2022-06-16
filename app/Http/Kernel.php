<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'projet'=>\App\Http\Middleware\ControleProjet::class,
        'projetlecture'=>\App\Http\Middleware\ControleProjetlecture::class,
        'controle_espace_equipe'=>\App\Http\Middleware\ControleEspaceequipe::class,
        'controle_gestion_division'=>\App\Http\Middleware\ControleGestionDivision::class,
        'controle_gestion_phase'=>\App\Http\Middleware\ControleGestionPhase::class,
        'controle_gestion_role'=>\App\Http\Middleware\ControleGestionRole::class,
        'controle_gestion_utilisateur'=>\App\Http\Middleware\ControleGestionUtilisateur::class,
        'controle_historique_equipe'=>\App\Http\Middleware\ControleHistoriqueequipe::class,
        'controle_creation_projet'=>\App\Http\Middleware\ControleProjetcreation::class,
        'controle_statistique'=>\App\Http\Middleware\ControleStatistique::class,
        'controle_archivage'=>\App\Http\Middleware\ControleProjetarchivage::class,
        'controle_supression'=>\App\Http\Middleware\ControleProjetsupression::class,
        'controle_passer_phase_projet'=>\App\Http\Middleware\ControleProjetPhaseSuivante::class,
    ];
}
