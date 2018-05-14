<?php
namespace AppBundle\Service;

use AppBundle\Entity\Movie;

class MovieService extends CrudService implements IMovieService
{
    public function __construct($em, $form, $request)
    {
        parent::__construct($em, $form, $request);
    }

    public function findById($movieId)
    {
        return $this->getRepo()->findOneBy(['id'=>$movieId]);
    }
    
    public function deleteMovie($movieId)
    {}

    public function getAllMovies()
    {
        return $this->getRepo()->findAll();
    }

    public function findByTitle($movieTitle)
    {}

    public function findByYear($year)
    {}

    public function saveMovie($oneMovie)
    {
        $this->em->persist($oneMovie);
        $this->em->flush();
        return $oneMovie->getId();
    }

    public function getRepo()
    {
        return $this->em->getRepository(Movie::class);
    }
}

