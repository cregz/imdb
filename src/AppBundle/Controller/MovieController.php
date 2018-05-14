<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\IMovieService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Domain\MovieObject;
use AppBundle\Form\MovieFormType;
use AppBundle\Domain\ReviewObject;
use AppBundle\Form\ReviewFormType;
use AppBundle\Service\IReviewService;
use AppBundle\Service\IMovieFacade;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Review;

class MovieController extends Controller
{
    /**
     * 
     * @var IMovieService
     */
    private $movieService;
    
    /**
     * 
     * @var IReviewService
     */
    private $reviewService;
    
    /**
     * 
     * @var IMovieFacade
     */
    private $movieFacade;
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->movieService=$container->get('app.movieService');
        $this->reviewService=$container->get('app.reviewService');
        $this->movieFacade=$container->get('app.movieFacade');
    }
    
    /**
     * @Route("/movies/list", name="listmovies")
     */
    public function listAction(Request $request)
    {
        $movies = $this->movieService->getAllMovies();
        
        $twigParams = array("movies"=>$movies);
        return $this->render('movies/movielist.html.twig', $twigParams);
    }
    
    /**
     * @Route("/movies/new", name="addmovie")
     * @Security("has_role('ROLE_USER')")
     */
    public function addMovieAction(Request $request)
    {
        $movie = new Movie();
        
        $form = $this->createForm(MovieFormType::class, $movie);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $id = $this->movieService->saveMovie($movie);
            
            return $this->redirectToRoute('showmovie', ['movieId'=>$id]);  
        }
        
        return $this->render('movies/movieadd.html.twig', array('form'=>$form->createView()));
    }
    
    /**
     * @Route("/movies/show/{movieId}", name="showmovie")
     */
    public function showAction(Request $request, $movieId=0)
    {
        if($movieId){
            $movie = $this->movieService->findById($movieId);
        }
        else{
            $this->redirectToRoute('listmovies');
        }
        $twigParams = array("movie"=>$movie);
        return $this->render('movies/movieshow.html.twig', $twigParams);
    }
    
    /**
     * @Route("movies/addreview/{movieId}", name="addreview")
     */
    public function addReviewAction(Request $request, $movieId=0)
    {
        if($movieId){
            $movie = $this->movieService->findById($movieId);
            $review = new Review();
            $review->setReviewMovie($movie);
            $review->setReviewAuthor($this->getUser());
            $form = $this->createForm(ReviewFormType::class, $review);
            
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $this->reviewService->saveReview($review);
                
                return $this->redirectToRoute('showmovie', ['movieId'=>$movieId]);
                
            }
            
        }
        else{
            //TODO
        }
       // $movie = $this->movieService->findById($movieId);
        $twigParams = array("movie"=>$movie, "form"=>$form->createView());
        return $this->render('reviewadd.html.twig', $twigParams);
        
    }
}

