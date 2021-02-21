<?php

namespace App\Security;

use App\Entity\User;

class GoogleConnectAuthenticator extends AbstractSocialAuthenticator
{
    public string $key = "google_main";
    public string $socialId = "googleId";
    public string $socialRoute = "connect_google_check";

    /**
     * @param User $user
     * @param $socialId
     * @return mixed|void
     */
    public function setSocialIdUser(User $user, $socialId)
    {
        $user->setGoogleId($socialId);
    }
}