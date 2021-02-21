<?php


namespace App\Security;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
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
    private ClientRegistry $clientRegistry;
    private EntityManagerInterface $em;
    private RouterInterface $router;

    public string $key;
    public string $socialId;
    public string $socialRoute;

    /**
     * AbstractSocialAuthenticator constructor.
     * @param ClientRegistry $clientRegistry
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     */
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === $this->getSocialRoute();
    }

    /**
     * @param Request $request
     * @return \League\OAuth2\Client\Token\AccessToken|mixed
     */
    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getSocialClient());
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return User|object|\Symfony\Component\Security\Core\User\UserInterface|null
     */
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
        $this->setSocialIdUser($user, $this->getSocialId());
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @return \KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface
     */
    public function getSocialClient(): OAuth2ClientInterface
    {
        return $this->getClientRegistry()
            // the key used in config/packages/knpu_oauth2_client.yaml
            ->getClient($this->getKey());
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): RedirectResponse
    {
        $targetUrl = $this->router->generate('home');
        return new RedirectResponse($targetUrl);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return RedirectResponse
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
     * @param User $user
     * @param $socialId
     * @return mixed
     */
    public abstract function setSocialIdUser(User $user, $socialId);

}