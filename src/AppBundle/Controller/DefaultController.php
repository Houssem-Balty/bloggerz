<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FacebookBundle\Entity\Facebook as FacebookAccount ;
use Facebook\Facebook;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $fb = new Facebook([
        'app_id' => '1128001770660612', // Replace {app-id} with your app id
        'app_secret' => '2e0e324dfb0da7791da617385ad9c759',
        'default_graph_version' => 'v2.2',
        ]);

  
        $facebook = new FacebookAccount();

        $facebook = $this->getDoctrine()
        ->getRepository('FacebookBundle:Facebook')
        ->findOneById('6');






        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
