<?php



namespace SHOP\CRM\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserProfile extends Authenticatable
{
    use Notifiable, Userstamps ;

    protected $table = 'user_profiles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'provider',
        'provider_id',
        'full_name',
        'avatar',
        'dob',
        'gender',
        'phone',
        'phone_code',
        'password',
        'email',
        'address',
        'province_code',
        'district_code',
        'ward_code',
        'province',
        'district',
        'ward',
        'username',
        'last_login',
        'referral_code',
        'referral_user',
        'total_referral',
        'user_invited',
        'member_type',
        'token',
        'rating',
        'is_new',
        'sub_description',
        'total_referral',
        'status',
        'deleted',
        'status_log',
        'identification',
        'banking_info',
        'created_by',
        'modified_by'
    ];

    protected $hidden = [
        'password', 'token',
    ];

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

}
