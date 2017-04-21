<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PageController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $blogs = $em->getRepository('BlogBundle:Blog')
                    ->getLatestBlogs();


        return $this->render('BlogBundle:Page:index.html.twig', ['blogs' => $blogs]);
    }


    public function aboutAction()
    {
        return $this->render('BlogBundle:Page:about.html.twig');
    }


    public function contactAction(Request $request)
    {
        $enquire = new Enquiry();

        $form = $this->createForm(EnquiryType::class, $enquire);

        if($request->isMethod($request::METHOD_POST)){
            $form->handleRequest($request);

            if($form->isValid()){


                return $this->redirect($this->generateUrl('BlogBundle_contact'));
            }
        }
        return $this->render('BlogBundle:Page:contact.html.twig', ['form' => $form->createView()]);
    }
}