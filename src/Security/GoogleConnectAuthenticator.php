<?php

namespace App\Security;

class GoogleConnectAuthenticator extends AbstractSocialAuthenticator
{
    public $key = "google_main";
    public $socialId = "googleId";
    public $socialRoute = "connect_google_check";

}