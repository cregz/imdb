<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="movies")
 * @Vich\Uploadable
 * 
 */
class Movie extends BaseEntity
{   
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $movie_title;
    
    /**
     * @ORM\Column(type="text")
     */
    private $movie_plot;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $movie_picture;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $movie_year;
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $movie_rating;
    
    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="review_movie")
     */
    private $movie_reviews;
    
    /**
     * @Vich\UploadableField(mapping="movie_picture", fileNameProperty="movie_picture")
     * @var File
     */
    private $imageFile;
    
    /**
     * 
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;
        
        if(null !== $image){
            $this->updatedAt = new \DateTime();
        }
    }
    
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movie_roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->movie_reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set movieTitle
     *
     * @param string $movieTitle
     *
     * @return Movie
     */
    public function setMovieTitle($movieTitle)
    {
        $this->movie_title = $movieTitle;

        return $this;
    }

    /**
     * Get movieTitle
     *
     * @return string
     */
    public function getMovieTitle()
    {
        return $this->movie_title;
    }

    /**
     * Set moviePlot
     *
     * @param string $moviePlot
     *
     * @return Movie
     */
    public function setMoviePlot($moviePlot)
    {
        $this->movie_plot = $moviePlot;

        return $this;
    }

    /**
     * Get moviePlot
     *
     * @return string
     */
    public function getMoviePlot()
    {
        return $this->movie_plot;
    }

    /**
     * Set moviePicture
     *
     * @param string $moviePicture
     *
     * @return Movie
     */
    public function setMoviePicture($moviePicture)
    {
        $this->movie_picture = $moviePicture;

        return $this;
    }

    /**
     * Get moviePicture
     *
     * @return string
     */
    public function getMoviePicture()
    {
        return $this->movie_picture;
    }

    /**
     * Set movieYear
     *
     * @param integer $movieYear
     *
     * @return Movie
     */
    public function setMovieYear($movieYear)
    {
        $this->movie_year = $movieYear;

        return $this;
    }

    /**
     * Get movieYear
     *
     * @return integer
     */
    public function getMovieYear()
    {
        return $this->movie_year;
    }

    /**
     * Set movieRating
     *
     * @param float $movieRating
     *
     * @return Movie
     */
    public function setMovieRating($movieRating)
    {
        $this->movie_rating = $movieRating;

        return $this;
    }

    /**
     * Get movieRating
     *
     * @return float
     */
    public function getMovieRating()
    {
        return $this->movie_rating;
    }

    /**
     * Add movieReview
     *
     * @param \AppBundle\Entity\Review $movieReview
     *
     * @return Movie
     */
    public function addMovieReview(\AppBundle\Entity\Review $movieReview)
    {
        $this->movie_reviews[] = $movieReview;

        return $this;
    }

    /**
     * Remove movieReview
     *
     * @param \AppBundle\Entity\Review $movieReview
     */
    public function removeMovieReview(\AppBundle\Entity\Review $movieReview)
    {
        $this->movie_reviews->removeElement($movieReview);
    }

    /**
     * Get movieReviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovieReviews()
    {
        return $this->movie_reviews;
    }
}
