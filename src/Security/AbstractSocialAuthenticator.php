<?php


namespace App\Security;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\SocialClient;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

abstract class AbstractSocialAuthenticator extends SocialAuthenticator
{
    private $clientRegistry;
    private $em;
    private $router;

    public $key;
    public $socialId;
    public $socialRoute;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === $this->getSocialRoute();
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getSocialClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $socialUser = $this->getSocialClient()
            ->fetchUserFromToken($credentials);

        $email = $socialUser->getEmail();
        // 1) have they logged in with Social before? Easy!
        $existingUser = $this->em->getRepository(User::class)
            ->findOneBy([$this->getSocialId() => $socialUser->getId()]);
        if ($existingUser) {
            return $existingUser;
        }

        // 2) do we have a matching user by email?
        $user = $this->em->getRepository(User::class)
            ->findOneBy(['email' => $email]);

        if (is_null($user)) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword("__API__GENERATED__");
        }

        // 3) Maybe you just want to "register" them by creating
        // a User object
        $user->setSocialId($socialUser->getId());
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function getSocialClient()
    {
        return $this->getClientRegistry()
            // the key used in config/packages/knpu_oauth2_client.yaml
            ->getClient($this->getKey());
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $targetUrl = $this->router->generate('home');
        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse(
            '/connect/', // might be the site, where users choose their oauth provider
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return AbstractSocialAuthenticator
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocialId()
    {
        return $this->socialId;
    }

    /**
     * @param mixed $socialId
     * @return AbstractSocialAuthenticator
     */
    public function setSocialId($socialId)
    {
        $this->socialId = $socialId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocialRoute()
    {
        return $this->socialRoute;
    }

    /**
     * @param mixed $socialRoute
     * @return AbstractSocialAuthenticator
     */
    public function setSocialRoute($socialRoute)
    {
        $this->socialRoute = $socialRoute;
        return $this;
    }

    /**
     * @return ClientRegistry
     */
    public function getClientRegistry(): ClientRegistry
    {
        return $this->clientRegistry;
    }

    /**
     * @param ClientRegistry $clientRegistry
     * @return SocialAuthenticator
     */
    public function setClientRegistry(ClientRegistry $clientRegistry): SocialAuthenticator
    {
        $this->clientRegistry = $clientRegistry;
        return $this;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEm(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @param EntityManagerInterface $em
     * @return SocialAuthenticator
     */
    public function setEm(EntityManagerInterface $em): SocialAuthenticator
    {
        $this->em = $em;
        return $this;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * @param RouterInterface $router
     * @return SocialAuthenticator
     */
    public function setRouter(RouterInterface $router): SocialAuthenticator
    {
        $this->router = $router;
        return $this;
    }




}