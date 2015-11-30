<?php

namespace Rezo\Bundle\BlogBundle\Controller;

use Rezo\Bundle\BlogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function showAction(Category $category, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('BlogBundle:Category')->findAll();
        $posts = $category->getPosts();

        return $this->render('BlogBundle:Default:index.html.twig', array(
            'categories' => $categories,
            'category' => $category,
            'posts' => $posts,
        ));
    }

    public function listAction() {


        $categories = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('BlogBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }
}
