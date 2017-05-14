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


class MainController extends Controller
{



    /**
     * @Route("/dashboard/", name="dashborad_route")
     */
    public function dataListAction(Request $request)
    {
        $session = new Session();

        $accessToken=$session->get('fb_access_token');
        $fb = new Facebook([
            'app_id' => '1128001770660612', // Replace {app-id} with your app id
            'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
            'default_graph_version' => 'v2.2',
        ]);
        var_dump($fb->get('/me?fields=id,name',$accessToken)) ;
        return $this->render('main/dashboard.html.twig');
    }





    /**
     *
     *
     * @Route("/facebook/add/{permissions}", name="Facebook_add")
     */
    public function facebookAddAction(Request $request,$permissions)
    {
      $fb= new Facebook([
          'app_id' => '1128001770660612',
          'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
          'default_graph_version' => 'v2.5',
        ]);

        $defaultPermissions = ['email','public_profile'];
        $defaultPermissions [] = $permissions;
        // ['email','pages_messaging','manage_pages','read_insights','publish_actions'];
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl('http://localhost:8000/login/callback', $defaultPermissions);
        return $this->redirect($loginUrl);
    }

    /**
     * @Route("/login/facebook", name="facebook_login")
     */
    public function facebookLoginAction(Request $request)
    {
            $session = new Session();
            $session->start();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/login/callback", name="facebook_callback")
     */
    public function facebookCallbackAction(Request $request)
    {

        $session = new Session();
        if (!$session->has('FBRLH_state'))
        $session->start();

        $fb = new Facebook([
  'app_id' => '1128001770660612', // Replace {app-id} with your app id
  'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];
$session->set('FBRLH_state',$session->get('state'));
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

  var_dump($session->get('fb_access_token'));
  $accountId= $fb->get('/me?fields=id,name,picture,permissions',$accessToken->getValue());
  $data= $accountId->getDecodedBody();
  $owner = $this->getDoctrine()
  ->getRepository('AppBundle:User')
  ->findOneById("5");

  $facebook = new FacebookAccount();
  $facebook->setAccountId($data['id']);
  $facebook->setAccountName($data['name']);
  $facebook->setPicture($data['picture']['data']['url']);
  $facebook->setAccessToken($accessToken->getValue());
  $facebook->setUserOwner($owner);
  $facebook->setPermissions($data['permissions']);


  $em = $this->getDoctrine()
  ->getManager();
  if ( ! $this->getDoctrine()->getRepository('FacebookBundle:Facebook')->findOneByAccountId($data['id']) ){
    $em->persist($facebook) ;
    $em->flush() ;
} else {
  $facebook = $this->getDoctrine()->getRepository('FacebookBundle:Facebook')->findOneByAccountId($data['id']) ;
  $facebook->setPermissions($data['permissions']);
  $facebook->setAccessToken($accessToken->getValue());
  print_r($facebook->getPermissions()) ;
  $em->flush();

}








        return $this->redirectToRoute('homepage', [
          'message' => 'Account Added Successfully'
        ]);
    }


}
