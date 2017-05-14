<?php

/**
 * Created by PhpStorm.
 * User: Balti
 * Date: 12/05/2017
 * Time: 19:35
 */


namespace FacebookBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Facebook\Facebook;
use Symfony\Component\HttpFoundation\Session\Session;
use FacebookBundle\Entity\Facebook as FacebookAccount;


class GroupsController extends Controller
{


    /**
     * @Route("/facebook/groups/list/{id}", name="get_groups")
     */

    public function listAction(Request $request, $id)
    {

        $fb = new Facebook([
        'app_id' => '1128001770660612', // Replace {app-id} with your app id
        'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
        'default_graph_version' => 'v2.2',
        ]);

        $account = $this->getDoctrine()
        ->getRepository('FacebookBundle:Facebook')
        ->findOneByAccountId($id) ;

        try {
            $groups = $fb->get($id.'/groups?limit=100',$account->getAccessToken());
        } catch (Exception $e) {
            return $this->redirectToRoute('Facebook_add',array(
              'permission' => 'user_managed_groups',
            ));
        }

        echo '<pre>';
        print_r($groups->getDecodedBody());

        return $this->render('user/accounts.html.twig');
    }




}
