<?php

namespace Rezo\Bundle\AdminBundle\Controller\Blog;

use Rezo\Bundle\BlogBundle\Entity\Category;
use Rezo\Bundle\BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminCategoryController extends Controller
{
    public function indexAction(Request $request, $id, Category $category = null)
    {
        $em = $this->getDoctrine()->getManager();

        if ($category === null) {
            $category = new Category();
        }

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            if ($id === null) {
                $this->addFlash('success', array(
                    'title' => 'Category',
                    'msg' => 'New category created'
                ));
            } else {
                $this->addFlash('info', array(
                    'title' => 'Category',
                    'msg' => 'Category #' . $id . ' saved',
                ));
            }
            return $this->redirectToRoute('admin_blog_category');
        }

        $categories = $em->getRepository('BlogBundle:Category')->findAll();
        return $this->render('AdminBundle:Blog/Category:index.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories,
        ));
    }

    public function deleteAction(Category $category, $id) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($category);
        $em->flush();

        $this->addFlash('danger', array(
            'title' => 'Category',
            'msg' => 'Category #' . $id . ' deleted'
        ));

        return $this->redirectToRoute('admin_blog_category');
    }
}
