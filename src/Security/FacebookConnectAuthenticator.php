<?php

namespace App\Security;

use App\Entity\User;

class FacebookConnectAuthenticator extends AbstractSocialAuthenticator
{
    public $key = "facebook_main";
    public $socialId = "facebookId";
    public $socialRoute = "connect_facebook_check";

    public function setSocialIdUser(User $user, $socialId)
    {
        $user->setFacebookId($socialId);
    }
}