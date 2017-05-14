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
     * @Route("/blog/add", name="add_blog")
     */
    public function addAction(Request $request)
    {
      $blog = new Blog();
      $form = $this->createForm(BlogType::class,$blog);



      return $this->render('blog/blogAdd.html.twig',array(
        'form' => $form->createView()));
    }
}
