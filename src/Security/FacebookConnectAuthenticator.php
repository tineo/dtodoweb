<?php

namespace App\Security;

use App\Entity\User;

class FacebookConnectAuthenticator extends AbstractSocialAuthenticator
{
    public string $key = "facebook_main";
    public string $socialId = "facebookId";
    public string $socialRoute = "connect_facebook_check";

    /**
     * @param User $user
     * @param $socialId
     * @return mixed|void
     */
    public function setSocialIdUser(User $user, $socialId)
    {
        $user->setFacebookId($socialId);
    }
}