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
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;


class CategoryController extends Controller
{
    /**
     * @Route("/category/list", name="category_list")
     */
    public function listAction(Request $request)
    {
        $session = new Session();
        $categories = $this->getDoctrine()
        ->getManager()
        ->getRepository('FacebookBundle:Category')
        ->createQueryBuilder('c')
        ->getQuery()->iterate();




        return $this->render('category/category.html.twig',array(
          'data' => $categories,
        ));
    }

    /**
     * @Route("/category/add", name="category_add")
     */
    public function addAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class,$category);

        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
          $category = $form->getData();
          $em = $this->getDoctrine()
          ->getManager();

          $em->persist($category);
          $em->flush();

        }


      return $this->render('category/categoryAdd.html.twig', array(
        'form' => $form->createView(),
        )) ;

    }




}
