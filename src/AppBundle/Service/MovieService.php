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
    {
        $movie = $this->findById($movieId);
        $this->em->remove($movie);
        $this->em->flush();
    }

    public function getAllMovies()
    {
        return $this->getRepo()->findAll();
    }

    public function findByTitle($movieTitle)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('m')
        ->from('AppBundle:Movie', 'm')
        ->where('m.movie_title LIKE :movieTitle')
        ->orderBy('m.movie_year', 'ASC');
        $qb->setParameters(['movieTitle'=>'%'.$movieTitle.'%']);
        $query = $qb->getQuery();
        return $query->getResult();
    }

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

