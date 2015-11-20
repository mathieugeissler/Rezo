<?php
namespace Rezo\Bundle\AdminBundle\Controller;

use Rezo\Bundle\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rezo\Bundle\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

class AdminPostController extends Controller
{
    public function indexAction(Request $request, $id, Post $post = null)
    {
        $em = $this->getDoctrine()->getManager();

        if($post === null) {
            $post = new Post();
        }
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $post->setAuthor($user);

            $em->persist($post);
            $em->flush();

            if($id === null) {
                $this->addFlash('success', array(
                    'title' => 'Post',
                    'msg' => 'New post created'
                ));
            } else {
                $this->addFlash('info', array(
                    'title' => 'Post',
                    'msg' => 'Post #'.$id.' saved',
                ));
            }
            return $this->redirectToRoute('admin_blog_post');
        }

        $posts = $em->getRepository('BlogBundle:Post')->findAll();
        return $this->render(
            'AdminBundle:Blog/Post:index.html.twig', array(
                'posts' => $posts,
                'form' => $form->createView(),
            )
        );
    }

    public function deleteAction(Post $post, $id) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);
        $em->flush();

        $this->addFlash('warning', array(
            'title' => 'Post',
            'msg' => 'Post #'.$id.' deleted'
        ));

        return $this->redirectToRoute('admin_blog_post');
    }
}