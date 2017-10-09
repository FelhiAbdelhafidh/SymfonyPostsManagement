<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/post", name="view_post_route")
     */
    public function viewPostsAction()
    {
        $post= $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
//        echo '<pre>';
//        print_r($post);
//        echo '</pre>';
//        exit();        
        // replace this example code with whatever you need'
        return $this->render('pages/index.html.twig',['posts'=>$post]);
    } 
     /**
     * @Route("/post/create", name="create_post_route")
     */
    public function createPostAction(Request $request )
    {
        $post=new Post();
        $form= $this->createFormBuilder($post)
                ->add('title', TextType::class,array('attr'=>array('class'=>'form-control')))
                ->add('description', TextareaType::class,array('attr'=>array('class'=>'form-control')))
                ->add('category',TextType::class,array('attr'=>array('class'=>'form-control')))
                ->add('Save', SubmitType::class,array('label' => 'Create Post','attr'=>array('class'=>'btn btn-primary',
                    'style'=>'margin-top:10px')))
                    ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $title=$form['title']->getData();
            $description=$form['description']->getData();
            $category=$form['category']->getData();
            
            $post->setTitle($title);
            $post->setCategory($category);
            $post->setDescription($description);
            
            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('message', 'message saved successfully !');
            return $this->redirectToRoute('view_post_route');
            
            
        }
        // replace this example code with whatever you need
        return $this->render('pages/create.html.twig',['form'=>$form->createView()]);
    } 
    
     /**
     * @Route("/post/update/{id}", name="update_post_route")
     */
    public function updatePostAction($id,Request $request)
    {
        $post= $this->getDoctrine()->getRepository('AppBundle:Post')->find($id);
         
          $post->setTitle( $post->getTitle());
          $post->setDescription( $post->getDescription());
          $post->setCategory( $post->getCategory());
          
           $form= $this->createFormBuilder($post)
                ->add('title', TextType::class,array('attr'=>array('class'=>'form-control')))
                ->add('description', TextareaType::class,array('attr'=>array('class'=>'form-control')))
                ->add('category',TextType::class,array('attr'=>array('class'=>'form-control')))
                ->add('Save', SubmitType::class,array('label' => 'Update Post','attr'=>array('class'=>'btn btn-primary',
                    'style'=>'margin-top:10px')))
                    ->getForm();
           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
            $title=$form['title']->getData();
            $description=$form['description']->getData();
            $category=$form['category']->getData();
            
           
            
            $em=$this->getDoctrine()->getManager();
           $post= $em->getRepository('AppBundle:Post')->find($id);
           
            $post->setTitle($title);
            $post->setCategory($category);
            $post->setDescription($description);
            
            
            $em->flush();
            $this->addFlash('message', 'post updated successfully !');
            return $this->redirectToRoute('view_post_route');
            
            
        }
        
        // replace this example code with whatever you need
        return $this->render('pages/update.html.twig',['form'=>$form->createView()]);
    } 
    
     /**
     * @Route("/post/show/{id}", name="show_post_route")
     */
    public function showPostAction($id, Request $request)
    {
          $post= $this->getDoctrine()->getRepository('AppBundle:Post')->find($id);
         
          
        // replace this example code with whatever you need
        return $this->render('pages/view.html.twig',['post'=>$post]);
    } 
    
     /**
     * @Route("/post/delete/{id}", name="delete_post_route")
     */
    public function deletePostAction($id, Request $request)
    {
         $em=$this->getDoctrine()->getManager();
           $post= $em->getRepository('AppBundle:Post')->find($id);
           $em->remove($post);
            $em->flush();
            $this->addFlash('message', 'post deleted successfully !');
            return $this->redirectToRoute('view_post_route');
            
    } 
    
    
}
