<?php
namespace AppBundle\Service;

use AppBundle\Entity\Review;
use AppBundle\Domain\ReviewObject;
use AppBundle\Entity\Movie;

class ReviewService extends CrudService implements IReviewService
{

    public function __construct($em, $form, $request)
    {
        parent::__construct($em, $form, $request);
    }
    
    public function getAllReviews()
    {
        return $this->getRepo()->findAll();
    }

    public function findById($reviewId)
    {
        return $this->getRepo()->findOneBy(['id'=>$reviewId]);
    }

    public function convertToDTO($review)
    {
        $reviewDTO = new ReviewObject();
        $reviewDTO->setAuthorId($review->getReviewAuthor()->getId());
        $reviewDTO->setAuthorName($review->getReviewAuthor()->getUserNickname());
        $reviewDTO->setId($review->getId());
        $reviewDTO->setMovieId($review->getReviewMovie()->getId());
        $reviewDTO->setMovieName($review->getReviewMovie()->getMovieTitle());
        $reviewDTO->setRating($review->getReviewRating());
        $reviewDTO->setText($review->getReviewText());
        
        return $reviewDTO;
    }

    public function saveReview($review)
    {
        $this->em->persist($review);
        $this->em->flush();
        return $review->getId();
    }

    public function findAllForUser($userId)
    {
        return $this->getRepo()->findBy(['review_author'=>$userId]);
    }

    public function listForMovie($movieId)
    {
        return $this->getRepo()->findBy(['review_movie'=>$movieId]);
    }
    
    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\IReviewService::listRecentForMovie()
     */
    public function listRecentForMovie($movieId)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('r')
           ->from('AppBundle:Review', 'r')
           ->where('r.review_movie = :movieId')
           ->orderBy('r.createdOn', 'DESC')
           ->setMaxResults(5);
        $qb->setParameters(['movieId'=>$movieId]);
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function createNew($reviewDTO, $user, $movie)
    {
        $review = new Review();
        $review->setReviewRating($reviewDTO->getRating());
        $review->setReviewText($reviewDTO->getText());
        $review->setReviewAuthor($user);
        $review->setReviewMovie($movie);
        
        $this->saveReview($review);
        
    }

    public function deleteReview($reviewId)
    {
        $review = $this->findById($reviewId);
        $this->em->remove($review);
        $this->em->flush();
    }

    public function getRepo()
    {
        return $this->em->getRepository(Review::class);
    }
}

