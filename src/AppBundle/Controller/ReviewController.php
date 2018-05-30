<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\IReviewService;
use AppBundle\Service\IMovieService;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\ReviewFormType;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Service\IUserService;
use AppBundle\Entity\Review;

class ReviewController extends Controller
{
    /**
     * 
     * @var IReviewService
     */
    private $reviewService;
    
    /**
     * 
     * @var IMovieService
     */
    private $movieService;
    
    /**
     *
     * @var IUserService
     */
    private $userService;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->movieService=$container->get('app.movieService');
        $this->reviewService=$container->get('app.reviewService');
        $this->userService=$container->get('app.userService');
    }
    
    /**
     * 
     * @Route("/reviews/show/{reviewId}", name="showreview")
     */
    public function showReviewAction(Request $request, $reviewId)
    {
        if($reviewId){
            $review = $this->reviewService->findById($reviewId);
        }
        else{
            //TODO
        }
        $twigParams = array("review"=>$review);
        return $this->render('reviews/reviewshow.html.twig', $twigParams);
        
    }
    
    /**
     *
     * @Route("/reviews/edit/{reviewId}", name="editreview")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editReviewAction(Request $request, $reviewId)
    {
        if($reviewId){
            $review = $this->reviewService->findById($reviewId);
            $form = $this->createForm(ReviewFormType::class, $review);
            
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $this->reviewService->saveReview($review);
                $avgRating = $this->reviewService->calculateAverageRating($review->getReviewMovie()->getId());
                $movie = $this->movieService->findById($review->getReviewMovie()->getId());
                $movie->setMovieRating($avgRating);
                $this->movieService->saveMovie($movie);
                return $this->redirectToRoute('showreview', ['reviewId'=>$reviewId]);
                
            }
        }
        else{
            //TODO
        }
        $twigParams = array("form"=>$form->createView(), "review"=>$review);
        return $this->render('reviews/reviewedit.html.twig', $twigParams);
        
    }
    
    /**
     * 
     * @Route("/reviews/list/{_forwhat}/{objectId}", name="listreviews", requirements={"objectId"="\d+", "_forwhat"="movie|user"})
     * 
     */
    public function listReviews(Request $request, $objectId = null, $_forwhat=null)
    {
        if($_forwhat === "movie"){
            $movie = $this->movieService->findById($objectId);
            $name = $movie->getMovieTitle();
            $reviews = $this->reviewService->listForMovie($objectId);
        } elseif ($_forwhat === "user"){
            $user = $this->userService->getUserById($objectId);
            $name = $user->getUserNickname();
            $reviews = $this->reviewService->findAllForUser($objectId);
        } else {
            $reviews = $this->reviewService->getAllReviews();
        }
        
        $page = $request->query->get('page', 1);
        
        $adapter = new ArrayAdapter($reviews);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setCurrentPage($page);
        
        $twigParams = array("reviews"=>$reviews, "pager"=>$pagerfanta);
        if(isset($name)){
            $twigParams["name"] = $name;
        }
        return $this->render('reviews/reviewlist.html.twig', $twigParams);
    }
    
    /**
     *
     * @Route("/reviews/delete/{reviewId}", name="deletereview")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteReviewAction(Request $request, $reviewId)
    {
        if($reviewId){
            $review = $this->reviewService->findById($reviewId);
            $movieId = $review->getReviewMovie()->getId();
            $this->reviewService->deleteReview($reviewId);
            $avgRating = $this->reviewService->calculateAverageRating($movieId);
            $movie = $this->movieService->findById($movieId);
            $movie->setMovieRating($avgRating);
            $this->movieService->saveMovie($movie);
        }
        else{
            //TODO
        }
        
        return $this->redirect('/reviews/list/movie/'.$movieId/*, ['_forwhat'=>'movie', 'movieId'=>$movieId]*/);
    }
    
    /**
     * @Route("movies/addreview/{movieId}", name="addreview")
     * @Security("has_role('ROLE_USER')")
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
                $avgRating = $this->reviewService->calculateAverageRating($movieId);
                $movie = $this->movieService->findById($movieId);
                $movie->setMovieRating($avgRating);
                $this->movieService->saveMovie($movie);
                
                return $this->redirectToRoute('showmovie', ['movieId'=>$movieId]);
                
            }
            
        }
        else{
            //TODO
        }
        $twigParams = array("movie"=>$movie, "form"=>$form->createView());
        return $this->render('reviews/reviewadd.html.twig', $twigParams);
        
    }
}

