<?php
namespace AppBundle\Service;

use AppBundle\Entity\Review;
use AppBundle\Entity\Movie;
use AppBundle\Entity\User;

class MovieFacade implements IMovieFacade
{
    /**
     * @var IMovieService
     */
    private $movieService;
    
    /**
     * @var IReviewService
     */
    private $reviewService;
    
    /**
     * @var IUserService
     */
    private $userService;

    public function __construct(IMovieService $movieService, IReviewService $reviewService, IUserService $userService)
    {
        $this->movieService = $movieService;
        $this->reviewService = $reviewService;
        $this->userService = $userService;
    }

    public function updateMovie($movieDTO)
    {
        
    }

    public function createNewMovie($movieDTO)
    {}

    public function createNewReview($reviewDTO)
    {
        $movie = $this->movieService->findById($reviewDTO->getMovieId());
        $user = $this->userService->getUserById($reviewDTO->getAuthorId());
        $review = new Review();
        $review->setReviewMovie($movie);
        $review->setReviewAuthor($user);
        $review->setReviewRating($reviewDTO->getRating());
        $review->setReviewText($reviewDTO->getText());
        
        $this->reviewService->saveReview($review);
    }

    public function updateReview($reviewDTO)
    {}
}

