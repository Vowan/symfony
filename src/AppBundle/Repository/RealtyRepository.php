<?php


namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;



class RealtyRepository extends EntityRepository {

    public function getRealtiesByTownAndRegion($name, $region) {
        
     //   dump($name, $region);
           
        $query = $this->getEntityManager()
                ->createQuery("SELECT r, t FROM AppBundle\Entity\Realty r JOIN r.town t WHERE t.name = :name AND t.region = :region");
                        
        $query->setParameters(array(
            'name' => $name,
            'region' => $region,
            
        ));
       
        return $query->getResult();
    }
    
     public function getRealtiesForJson($name, $region) {
        
     //   dump($name, $region);
           
        $query = $this->getEntityManager()
                ->createQuery("SELECT r.uuid, r.type, r.title, r.price,"
                        . " r.latitude, r.longitude FROM AppBundle\Entity\Realty r "
                        . "JOIN r.town t WHERE t.name = :name AND t.region = :region");
                        
        $query->setParameters(array(
            'name' => $name,
            'region' => $region,
            
        ));
       
        return $query->getResult();
    }
    
    public function getRealtyByUUID($uuid) {
        
     //   dump($name, $region);
           
        $query = $this->getEntityManager()
                ->createQuery("SELECT r, a  FROM AppBundle\Entity\Realty r "
                        . "JOIN r.agent a WHERE r.uuid = :uuid");
                        
        $query->setParameters(array(
            'uuid' => $uuid,
            
        ));
       
        return $query->getResult();
    }


}