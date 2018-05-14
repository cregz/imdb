<?php
namespace AppBundle\Domain;

class ReviewObject
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $rating;
    
    /**
     * @var string
     */
    private $text;
    
    /**
     * @var integer
     */
    private $authorId;
    
    /**
     * @var string
     */
    private $authorName;
    
    /**
     * @var integer
     */
    private $movieId;
    
    /**
     * @var string
     */
    private $movieName;
    
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return number
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return number
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return number
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @return string
     */
    public function getMovieName()
    {
        return $this->movieName;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param number $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @param number $movieId
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;
    }

    /**
     * @param string $movieName
     */
    public function setMovieName($movieName)
    {
        $this->movieName = $movieName;
    }

    
}

