<?php  
namespace App\Controller; 

use App\Entity\Bookz;
use App\Form\AddBookType;
use App\Repository\BookzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\HttpFoundation\Request; 

class BooksController extends AbstractController
{ 
  
/**
 * @Route("/", name="app_book_list")
 */
   public function index(BookzRepository $books): Response
   {
      $bk = $books->findAll(); 
        
      return $this->render('books/index.html.twig', array('data' => $bk)); 
   }

/**
   * @Route ("/new", name="app_book_new") 
 * */
   public function newAction(Request $request): Response
   { 
      $bookz = new Bookz();
        
      $form = $this->createForm(AddBookType::class, $bookz);
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
            'title' => 'Добавить книгу'
         )); 
      } 
   }

/** 
* @Route("/update/{id}", name = "app_book_update" ) 
*/ 
public function update(int $id, Request $request, BookzRepository $books): Response
{ 
    
   $bk = $books->find($id);  
    
   if (!$bk) { 
      throw $this->createNotFoundException( 
         'No book found for id '.$id 
      ); 
   }  
   $form = $this->createForm(AddBookType::class, $bk);
   
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
         'title' => 'Редактировать книгу'
      )); 
   } 
}

/** 
   * @Route("/delete/{id}", name="app_book_delete") 
*/ 
public function delete(int $id, BookzRepository $books): Response
   { 
      $doct = $this->getDoctrine()->getManager(); 
      $bk = $books->find($id); 
      
      if (!$bk) { 
         throw $this->createNotFoundException(
            'No book found for id '.$id); 
      } 
      $doct->remove($bk); 
      $doct->flush(); 

      return $this->redirectToRoute('app_book_list'); 
   } 
}  
