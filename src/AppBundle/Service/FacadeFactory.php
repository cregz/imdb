<?php
namespace AppBundle\Service;

class FacadeFactory
{
    /**
     * 
     * @var IUserService
     */
    private $userService;
    
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
    

    public function __construct(IUserService $userService, IMovieService $movieService, IReviewService $reviewService)
    {
        $this->userService = $userService;
        $this->movieService =$movieService;
        $this->reviewService = $reviewService;
    }
    
    public function getMovieFacade()
    {
        return new MovieFacade($this->movieService, $this->reviewService, $this->userService);
    }
}

