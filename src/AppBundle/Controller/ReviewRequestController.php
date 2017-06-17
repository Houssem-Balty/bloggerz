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
use AppBundle\Entity\ReviewRequest;
use AppBundle\Form\ReviewRequestType;


class ReviewRequestController extends Controller
{


    /**
     * @Route("/review-request/send/{userRecieve_id}", name="review_request_add")
     */
    public function addAction(Request $request, $userRecieve_id)
    {
        $reviewRequest = new ReviewRequest();
        $form = $this->createForm(ReviewRequestType::class,$reviewRequest);
        $userRecieve = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->findOneById($userRecieve_id);

        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
          $reviewRequest = $form->getData();
          $reviewRequest->setUserDeclare($this->getUser());
          $reviewRequest->setUserRecieve($userRecieve);
          $reviewRequest->setStatus("pending");
          $reviewRequest->setExpiryDate(new \DateTime());
          $em = $this->getDoctrine()
          ->getManager();

          $em->persist($reviewRequest);
          $em->flush();

        }


      return $this->render('reviewrequest/reviewAdd.html.twig', array(
        'form' => $form->createView(),

        )) ;

    }




}
