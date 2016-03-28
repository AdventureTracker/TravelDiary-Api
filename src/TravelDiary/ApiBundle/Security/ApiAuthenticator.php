<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 28.03.2016
 * Time: 14:53
 */

namespace TravelDiary\ApiBundle\Security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Http\HttpUtils;

class ApiAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface {

	protected $httpUtils;

	public function __construct(HttpUtils $utils) {
		$this->httpUtils = $utils;
	}

	public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey) {

		if (!$userProvider instanceof ApiUserProvider) {
			throw new \InvalidArgumentException(
				sprintf(
					"The user provider must be an instance of ApiUserProvider (%s was given)",
					get_class($userProvider)
				)
			);
		}

		$apiToken = $token->getCredentials();

		$user = $userProvider->loadUserByUsername($apiToken);

		if (!$user)
			throw new CustomUserMessageAuthenticationException("Invalid token!");

		return new PreAuthenticatedToken(
			$user,
			$apiToken,
			$providerKey,
			$user->getRoles()
		);

	}

	public function supportsToken(TokenInterface $token, $providerKey) {
		return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
	}

	public function createToken(Request $request, $providerKey) {

		$apiToken = $request->headers->get('X-TravelDiary-Token');

		// preskakujem auth ak sa jedna o status
		if ($this->httpUtils->checkRequestPath($request, '/api/v1/status'))
			return null;

		// preskakujem auth ak sa jedna o ziadost o novy token
		if ($this->httpUtils->checkRequestPath($request, '/api/v1/token') && ($request->getMethod() == Request::METHOD_POST))
			return null;

		if(!$apiToken)
			throw new BadCredentialsException('No token found!');

		return new PreAuthenticatedToken('anon.', $apiToken, $providerKey);

	}

	/**
	 * This is called when an interactive authentication attempt fails. This is
	 * called by authentication listeners inheriting from
	 * AbstractAuthenticationListener.
	 *
	 * @param Request $request
	 * @param AuthenticationException $exception
	 *
	 * @return Response The response to return, never null
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		return new JsonResponse(['message' => $exception->getMessage()], JsonResponse::HTTP_FORBIDDEN);
	}
}