<?php


namespace App\Controller;


use App\Entity\Article;
use App\Entity\Commente;
use App\Form\ArticleType;
use App\Form\CommenteType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends AbstractController
{
    public function index()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['user' => $user], ['date_publication' => 'desc']);

        if (!empty($articles)) {
            $commentaires = [];
            foreach ($articles as $article) {
                array_push($commentaires, $this->getDoctrine()
                    ->getRepository(Commente::class)
                    ->findBy(['article' => $article], ['date' => 'desc']));
            }
        } else {
            $articles = null;
        }
        if (empty($commentaires)) {
            $commentaires = null;
        }
        return $this->render('article/mon_compte.html.twig', [
            'articles' => $articles,
            'commentaires' => $commentaires,
        ]);
    }
}