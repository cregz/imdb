<?php
namespace AppBundle\Service;

use AppBundle\Domain\MovieObject;
use AppBundle\Domain\ReviewObject;

interface IMovieFacade
{
    /**
     * @return integer
     * @param MovieObject $movieDTO
     */
    public function createNewMovie($movieDTO);
    
    /**
     * 
     * @param MovieObject $movieDTO
     */
    public function updateMovie($movieDTO);
    
    /**
     * @return integer
     * @param ReviewObject $reviewDTO
     */
    public function createNewReview($reviewDTO);
    
    /**
     * 
     * @param ReviewObject $reviewDTO
     */
    public function updateReview($reviewDTO);
    
     
}

