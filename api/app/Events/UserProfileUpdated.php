<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use SHOP\CRM\Models\UserProfile;

class UserProfileUpdated
{
    use SerializesModels;

    public $profile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserProfile $profile)
    {
        $this->profile = $profile;
    }
}
