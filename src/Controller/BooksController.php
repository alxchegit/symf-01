<?php  
namespace App\Controller; 

use App\Entity\Bookz;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  


class BooksController extends AbstractController
{ 

/**
 * @Route("/", name="app_book_list")
 */
   public function listAction(): Response
   {
      $bk = $this->getDoctrine()
      ->getRepository('App:Bookz') 
      ->findAll(); 
      return $this->render('books/index.html.twig', array('data' => $bk)); 
   }

/**
   * @Route ("/new", name="app_book_new") 
 * */
   public function newAction(Request $request): Response
   { 
      $bookz = new Bookz();
         $form = $this->createFormBuilder($bookz) 
            ->add('Name', TextType::class, array('label' => 'Название')) 
            ->add('Author', TextType::class, array('label' => 'Автор')) 
            ->add('Year', TextType::class, array('label' => 'Год')) 
            ->add('save', SubmitType::class, array('label' => 'Добавить')) 
            ->getForm();  

         $form->handleRequest($request);  

         if ($form->isSubmitted() && $form->isValid()) { 
            $book = $form->getData(); 
            $doct = $this->getDoctrine()->getManager();  
            
            $doct->persist($book);  

            $doct->flush();  
            
            return $this->redirectToRoute('app_book_list'); 
         } else { 
            return $this->render('books/new.html.twig', array( 
               'form' => $form->createView(), 
            )); 
         } 
   }

/** 
* @Route("/update/{id}", name = "app_book_update" ) 
*/ 
public function update(int $id, Request $request): Response
{ 
   $doct = $this->getDoctrine()->getManager(); 
   $bk = $doct->getRepository('App:Bookz')->find($id);  
    
   if (!$bk) { 
      throw $this->createNotFoundException( 
         'No book found for id '.$id 
      ); 
   }  
   $form = $this->createFormBuilder($bk) 
      ->add('Name', TextType::class, array('label' => 'Название')) 
      ->add('Author', TextType::class, array('label' => 'Автор')) 
      ->add('Year', TextType::class, array('label' => 'Год')) 
      ->add('save', SubmitType::class, array('label' => 'Обновить')) 
      ->getForm();  
   
   $form->handleRequest($request);  
   
   if ($form->isSubmitted() && $form->isValid()) { 
      $book = $form->getData(); 
      $doct = $this->getDoctrine()->getManager();  
      
      $doct->persist($book);  
      
      $doct->flush(); 
      return $this->redirectToRoute('app_book_list'); 
   } else {  
      return $this->render('books/new.html.twig', array(
         'form' => $form->createView(), 
      )); 
   } 
}

/** 
   * @Route("/delete/{id}", name="app_book_delete") 
*/ 
public function delete(int $id): Response
   { 
      $doct = $this->getDoctrine()->getManager(); 
      $bk = $doct->getRepository('App:Bookz')->find($id); 
      
      if (!$bk) { 
         throw $this->createNotFoundException('No book found for id '.$id); 
      } 
      $doct->remove($bk); 
      $doct->flush(); 
      return $this->redirectToRoute('app_book_list'); 
   } 
}  
