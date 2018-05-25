<?php
namespace AppBundle\Service;

use AppBundle\Entity\Review;
use AppBundle\Domain\ReviewObject;
use AppBundle\Entity\User;
use AppBundle\Entity\Movie;

interface IReviewService
{
    /**
     * @return Review[]
     * @param integer $userId
     */
    public function findAllForUser($userId);
    
    /**
     * @return Review
     * @param integer $reviewId
     */
    public function findById($reviewId);
    
    /**
     * @return Review[]
     * @param integer $movieId
     */
    public function listForMovie($movieId);
    
    /**
     * @return Review{}
     * @param integer $movieId
     */
    public function listRecentForMovie($movieId);
    
    /**
     * 
     * @param Review $review
     */
    public function saveReview($review);
    
    /**
     * 
     * @param integer $reviewId
     */
    public function deleteReview($reviewId);
    
    /**
     * @param ReviewObject $reviewDTO
     * @param User $user
     * @param Movie $movie
     */
    public function createNew($reviewDTO, $user, $movie);
    
    /**
     * @return ReviewObject
     * @param Review $review
     */
    public function convertToDTO($review);
}