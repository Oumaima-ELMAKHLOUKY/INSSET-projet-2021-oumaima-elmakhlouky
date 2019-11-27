<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    public function new(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $article = new Article();
        $article->setUser($user);
        $article->setDatePublication(new \DateTime('now'));
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('article');
        }
        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}