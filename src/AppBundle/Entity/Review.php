<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reviews")
 *
 */
class Review extends BaseEntity
{
    /**
     * @ORM\Column(type="integer")
     */
    private $review_rating;
    
    /**
     * @ORM\Column(type="text")
     */
    private $review_text;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $review_author;
    
    /**
     * @ORM\ManyToOne(targetEntity="Movie")
     */
    private $review_movie;

    /**
     * Set reviewRating
     *
     * @param integer $reviewRating
     *
     * @return Review
     */
    public function setReviewRating($reviewRating)
    {
        $this->review_rating = $reviewRating;

        return $this;
    }

    /**
     * Get reviewRating
     *
     * @return integer
     */
    public function getReviewRating()
    {
        return $this->review_rating;
    }

    /**
     * Set reviewText
     *
     * @param string $reviewText
     *
     * @return Review
     */
    public function setReviewText($reviewText)
    {
        $this->review_text = $reviewText;

        return $this;
    }

    /**
     * Get reviewText
     *
     * @return string
     */
    public function getReviewText()
    {
        return $this->review_text;
    }

    /**
     * Set reviewAuthor
     *
     * @param \AppBundle\Entity\User $reviewAuthor
     *
     * @return Review
     */
    public function setReviewAuthor(\AppBundle\Entity\User $reviewAuthor = null)
    {
        $this->review_author = $reviewAuthor;

        return $this;
    }

    /**
     * Get reviewAuthor
     *
     * @return \AppBundle\Entity\User
     */
    public function getReviewAuthor()
    {
        return $this->review_author;
    }

    /**
     * Set reviewMovie
     *
     * @param \AppBundle\Entity\Movie $reviewMovie
     *
     * @return Review
     */
    public function setReviewMovie(\AppBundle\Entity\Movie $reviewMovie = null)
    {
        $this->review_movie = $reviewMovie;

        return $this;
    }

    /**
     * Get reviewMovie
     *
     * @return \AppBundle\Entity\Movie
     */
    public function getReviewMovie()
    {
        return $this->review_movie;
    }
}
