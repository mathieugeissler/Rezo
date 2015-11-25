<?php

namespace Rezo\Bundle\BlogBundle\Controller;

use Rezo\Bundle\BlogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function showAction(Category $category, $name)
    {
        $posts = $category->getPosts();

        return $this->render('BlogBundle:Category:show.html.twig', array(
            'category' => $category,
            'posts' => $posts,
        ));
    }

    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('BlogBundle:Category')->findAll();

        return $this->render('BlogBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }
}
