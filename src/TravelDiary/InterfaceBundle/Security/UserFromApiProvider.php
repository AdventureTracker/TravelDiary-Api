<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 23:21
 */

namespace TravelDiary\InterfaceBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;

class UserFromApiProvider implements SimpleFormAuthenticatorInterface
{

	public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
	{
		// TODO: Implement authenticateToken() method.
	}

	public function supportsToken(TokenInterface $token, $providerKey)
	{
		// TODO: Implement supportsToken() method.
	}

	public function createToken(Request $request, $username, $password, $providerKey)
	{
		// TODO: Implement createToken() method.
	}
}