<?php

namespace SHOP\Admin\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\Admin\Models\AdminPermissionRole;
use Exception;

class AdminUser extends Authenticatable implements JWTSubject
{
    use Notifiable, Userstamps;

    protected $table = 'admin_users';
    protected $admin_permission_role = AdminPermissionRole::class;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $hidden = [
        'password'
    ];

    protected $with = [
        'role'
    ];

    protected $fillable = [
        'role_id',
        'email',
        'username',
        'full_name',
        'phone',
        'dob',
        'gender',
        'state',
        'status',
        'locked',
    ];

    public function setDobAttribute($input)
    {
        $this->attributes['dob'] = Carbon::parse($input)->format('Y-m-d');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }

    public function isSuperAdmin()
    {
        return $this->role_id === 1;
    }

    public function isAdmin()
    {
        return $this->role_id === 2;
    }

    public function isManager()
    {
        return $this->role_id === 3;
    }

    public function getPermissions($role_id, $resource, $action)
    {
        $permissions = QueryBuilder::for($this->admin_permission_role)
            ->where('role_id', $role_id)
            ->where('resource', $resource)
            ->limit(1)
            ->get()
            ->toArray();
        if (count($permissions) > 0) {
            try {
                $list_action = json_decode($permissions[0]['permissions']);
                if (property_exists($list_action, $action)) {
                    if ($list_action->$action) return true;
                }
            } catch (Exception $e) {

            }
            return false;
        } else {
            return false;
        }
    }
}
