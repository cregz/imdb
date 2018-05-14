<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Movie;

class DataLoader extends Fixture implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * @var EntityManager
     */
    private $em;
    
    /**
     * @var string
     */
    private $environment;

    public function load(ObjectManager $manager)
    {
        $this->em = $manager;
        
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        
        for($i=0; $i<50; $i++){
            $movie = new Movie();
            $movie->setMovieTitle("Movie".$i);
            $movie->setMovieYear(1950+$i);
            $movie->setMoviePlot("Lorem ipsum");
            $movie->setMoviePicture("no picture");
            $movie->setMovieRating(5);
            $this->em->persist($movie);
        }
        $this->em->flush();
        
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $kernel = $this->container->get('kernel');
        if($kernel){
            $this->environment = $kernel->getEnvironment();
        }
    }

}

