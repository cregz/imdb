<?php
namespace AppBundle\Service;

use AppBundle\Entity\Movie;
use AppBundle\Domain\MovieObject;

interface IMovieService
{
    /**
     * @return Movie[]
     */
    public function getAllMovies();
    
    /**
     * @return Movie
     * @param integer $movieId
     */
    public function findById($movieId);
    
    /**
     * @return Movie[]
     * @param string $movieTitle
     */
    public function findByTitle($movieTitle);
    
    /**
     * @return Movie[]
     * @param integer $year
     */
    public function findByYear($year);
    
    /**
     * @return integer
     * @param Movie $oneMovie
     */
    public function saveMovie($oneMovie);
    
    /**
     * @param integer $movieId
     */
    public function deleteMovie($movieId);
    
}

