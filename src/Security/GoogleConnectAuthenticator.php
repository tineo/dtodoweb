<?php

namespace App\Security;

use App\Entity\User;

class GoogleConnectAuthenticator extends AbstractSocialAuthenticator
{
    public $key = "google_main";
    public $socialId = "googleId";
    public $socialRoute = "connect_google_check";

    public function setSocialIdUser(User $user, $socialId)
    {
        $user->setGoogleId($socialId);
    }
}