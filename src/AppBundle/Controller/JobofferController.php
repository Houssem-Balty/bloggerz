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
use AppBundle\Entity\JobOffer;
use AppBundle\Form\JobOfferType;


class JobofferController extends Controller
{


    /**
     * @Route("/joboffer/add", name="joboffer_add")
     */
    public function addAction(Request $request)
    {
        $joboffer = new JobOffer();

        $form = $this->createForm(JobOfferType::class,$joboffer);

        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
          $joboffer = $form->getData();
          $em = $this->getDoctrine()
          ->getManager();

          $em->persist($joboffer);
          $em->flush();

        }


      return $this->render('joboffer/jobofferAdd.html.twig', array(
        'form' => $form->createView(),
        )) ;

    }




}
