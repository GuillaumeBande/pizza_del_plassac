<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;



class AdminArticleController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil", methods={"GET"})
     */
    public function acceuil(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/article.html.twig', [
            'articles' => $articleRepository->findAll(),
            'title' => "Acceuil",

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('article/contact.html.twig', [
            'title' => "Contact",

        ]);

    }

    /**
     * @Route("/restaurant", name="restaurant")
     */
    public function restaurant(): Response
    {
        return $this->render('article/restaurant.html.twig', [
            'title' => "Restaurant",

        ]);
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservation(): Response
    {
        return $this->render('article/reservation.html.twig', [
            'title' => "Réservation",

        ]);

    }

    /**
     * @Route("/admin/article", name="admin_article_index", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('Admin_Article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("admin/new", name="admin_article_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $imageUrl = $form->get('imageUrl')->getData();

            if($imageUrl){
                try {
                    $imageUrl->move(
                        $this->getParameter('article_repository'),
                        $article->getTitle() . '.png'
                    );
                } catch (FileException $e){}
            }

            $em->persist($article);
            $em->flush();
        }



        return $this->renderForm('article/new.html.twig', [
            'form' => $form
        ]);
    }






//
//
//
//    /**
//     * @Route("/article/new", name="app_article_new")
//     */
//    public function new(Request $request, SluggerInterface $slugger)
//    {
//        $article = new article();
//        $form = $this->createForm(articleType::class, $article);
//        $form->handleRequest($request);
//
//
//    }









    /**
     * @Route("admin/article/{id}", name="admin_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("admin/{id}/edit", name="admin_article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("admin/{id}", name="admin_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }


//    /**
//     * @Route("/product/new", name="app_product_new")
//     * @param Request $request
//     * @param SluggerInterface $slugger
//     * @param EntityManager $entityManager
//     * @param $articleform
//     * @param $article
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function image(Request $request, SluggerInterface $slugger, EntityManager $entityManager, $articleform, $article): \Symfony\Component\HttpFoundation\RedirectResponse
//    {
//        $product = new Article();
//        $form = $this->createForm(ArticleType::class, $product);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()){
//            //Je recupère le nom de l'image dans le forulaire
//            $imageFile = $articleform->get('image')->getData();
//
//
//            // Ce test est necessaire parce que le champ 'image' n'est pas obligatoire
//            // donc la requete doit être executé que si l'image est uploadé
//            if ($imageFile) {
//                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFOFILENAME);
//
//                // permet de nettoyer le nom afin de pouvoir l'utiliser dans l'url (enleve les caractères spéciaux)
//                $safeFilename = $slugger->slug($originalFilename);
//                $newFilename = $safeFilename . '' . uniqid() . '.' . $imageFile->guessExtension();
//
//                //Déplace le fichier dans le dossier images ou uploads contenu dans le dossier publique
//                $imageFile->move(
//                    $this->getParameter('image_directory'),
//                    $newFilename
//                );
//
//                // MaJ 'imageFilename' property to store the PDF file name
//                // instead of its contents
//                $article->setImage($newFilename);
//            }
//
//
//            $entityManager->persist($article);
//            $entityManager->flush();
//        }
//
//        // ... persist the $product variable or any other work
//
//        return $this->redirectToRoute('article_index');
//    }
}




