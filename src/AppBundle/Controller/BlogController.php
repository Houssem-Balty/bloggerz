<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Blog;
use AppBundle\Form\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FacebookBundle\Entity\Facebook as FacebookAccount ;
use Facebook\Facebook;

class BlogController extends Controller
{

  /**
   * @Route("/blog/list", name="add_list")
   */
  public function listAction(Request $request)
  {
    $blogs = $this->getDoctrine()
    ->getRepository('AppBundle:Blog')
    ->createQueryBuilder('c')
    ->getQuery()->iterate();

    // returning all blogs

    return $this->render('blog/blogAdd.html.twig',array(
      'data' => $blogs));
  }


    /**
     * @Route("/blog/add", name="add_blog")
     */
    public function addAction(Request $request)
    {
      $blog = new Blog();
      $form = $this->createForm(BlogType::class,$blog);

      // handling Request
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $blog = $form->getData();
        $blog->setOwner($this->getUser()) ;
        $em = $this->getDoctrine()
        ->getManager();

        $em->persist($blog);
        $em->flush();

      }
      return $this->render('blog/blogAdd.html.twig',array(
        'form' => $form->createView()));
    }
}
