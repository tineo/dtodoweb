<?php

namespace App\Security;

class FacebookConnectAuthenticator extends AbstractSocialAuthenticator
{
    public $key = "facebook_main";
    public $socialId = "facebookId";
    public $socialRoute = "connect_facebook_check";

}