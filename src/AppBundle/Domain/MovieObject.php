<?php
namespace AppBundle\Domain;

class MovieObject
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var integer
     */
    private $year;
    
    /**
     * @var string
     */
    private $plot;
    
    /**
     * @var string
     */
    private $picture;
    
    /**
     * @var float
     */
    private $rating;
    
    /**
     * 
     * @var ReviewObject[]
     */
    private $reviews;

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return number
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return number
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return multitype:\AppBundle\Domain\ReviewObject 
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param number $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param string $plot
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @param number $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @param multitype:\AppBundle\Domain\ReviewObject  $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }   
    
}

