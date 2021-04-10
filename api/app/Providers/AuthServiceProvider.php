<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Auth\UserProvider;
use Log;
use Jenssegers\Agent\Agent;

/**
 * Class AuthServiceProvider
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('shop-users', function ($app, array $config) {
            return new UserProvider($app['hash'], $config['model']);
        });

        Gate::before(function ($user, $ability, $arguments) {
            $first = $arguments[0];
            $role_id = $user->role_id;
            $resource = (new $first)->getTable();
            if ($user->isSuperAdmin()) {
                return true;
            } elseif ($user->isAdmin()) {
                return true;
            } elseif ($user->isManager()) {
                if ($user->getPermissions($role_id, $resource, $ability)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($user->getPermissions($role_id, $resource, $ability)) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        Gate::after(function ($user, $ability, $has_permission, $arguments) {
            $first = $arguments[0];
            $request = $arguments[1];
            $resource = (new $first)->getTable();
            $agent = new Agent();

            if ($has_permission) {
                if ($ability == 'create' || $ability == 'update' || $ability == 'delete' || $ability == 'export' || $ability == 'import') {

                    $content = json_decode($request->getContent(), true);
                    $action = $ability;
                    switch ($ability) {
                        case 'create':
                            if (@$content['name']) $action = $ability . ' - ' . ' [name] ' . @$content['name'];
                            break;
                        case 'update':
                            if (@$content['id']) $action = $ability . ' - ' . ' [id] ' . @$content['id'];
                            break;
                        case 'delete':
                            if (@$content['id']) $action = $ability . ' - ' . ' [id] ' . @$content['id'];
                            break;
                    }

                    Log::channel('user_action')->info("$resource.$ability", [
                        $user->role_id,
                        $user->id,
                        $user->username,
                        $resource,
                        $action,
                        $request->ip(),
                        $agent->platform() . '-' . $agent->version($agent->platform()),
                        $agent->browser() . '-' . $agent->version($agent->browser()),
                        $request->userAgent()
                    ]);
                }
            }
        });
    }
}
