<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users_list")
     * @Method({"GET"})
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->getDoctrine()
                ->getManager()
                ->getRepository('UserBundle:User')
                ->findAll();

        $tabUsers = [];
        foreach($users as $user)
        {
            $tabUsers[]=[
                'id'=>$user->getId(),
                'username'=>$user->getUsername(),
                'email'=>$user->getEmail()
            ];
        }
        return new JsonResponse($tabUsers);
        
    }
}