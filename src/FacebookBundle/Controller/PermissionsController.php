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


class PermissionsController extends Controller
{


    /**
     * @Route("/permissions/{id}", name="manage_permissions")
     */
    public function permissionsListAction(Request $request, $id)
    {

        $fb = new Facebook([
        'app_id' => '1128001770660612', // Replace {app-id} with your app id
        'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
        'default_graph_version' => 'v2.2',
        ]);

        $facebook = $this->getDoctrine()
        ->getRepository('FacebookBundle:Facebook')
        ->findOneByAccountId($id);

        print_r($facebook->getPermissions());
        $fb->post($facebook->getAccountId().'/feed',['message' => 'This is a message'], $facebook->getAccessToken());

        return $this->render('user/accounts.html.twig');
    }


    /**
     * @Route("/permissions/add/{id}/{permission}", name="add_permissions")
     */
    public function permissionsAddAction(Request $request, $id, $permission)
    {
        return $this->redirectToRoute('Facebook_add',array('id' => $id,'permission' => $permission));
    }


    /**
     * @Route("/permissions/remove/{id}", name="remove_permissions")
     */
    public function permissionsRemoveAction(Request $request, $id)
    {
      $fb = new Facebook([
      'app_id' => '1128001770660612', // Replace {app-id} with your app id
      'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
      'default_graph_version' => 'v2.2',
      ]);

      $account = $this->getDoctrine()
      ->getRepository('FacebookBundle:Facebook')
      ->findOneByAccountId($id);


      $response = $fb->sendRequest('DELETE','/'.$id.'/permissions',[],$account->getAccessToken()) ;

      $em = $this->getDoctrine()->getManager() ;
      $em->remove($account);
      $em->flush();


      return $this->redirectToRoute('homepage');
    }


}
