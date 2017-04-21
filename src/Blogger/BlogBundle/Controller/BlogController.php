<?php

namespace Blogger\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository('BlogBundle:Comment')
            ->getCommentsForBlog($blog->getId());

        $md = $this->container->get('blog.markdown');
        $blog->setBlog($md->parse($blog->getBlog()));

        return $this->render('BlogBundle:Blog:show.html.twig', ['blog' => $blog, 'comments' => $comments]);
    }
}