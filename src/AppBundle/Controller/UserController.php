<?php
/**
 * Created by PhpStorm.
 * User: Balti
 * Date: 12/05/2017
 * Time: 19:35
 */


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Facebook\Facebook;
use Symfony\Component\HttpFoundation\Session\Session;
use FacebookBundle\Entity\Facebook as FacebookAccount;


class UserController extends Controller
{
    /**
     * @Route("/home", name="profile")
     */
    public function indexAction(Request $request)
    {
        $session = new Session();
        $facebookAccounts = $this->getDoctrine()
        ->getManager()
        ->getRepository('FacebookBundle:Facebook')
        ->createQueryBuilder('c')
        ->getQuery()->iterate();




        return $this->render('user/home.html.twig',array(
          'data' => $facebookAccounts,
        ));
    }




}
