<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TownRepository extends EntityRepository {

    public function getTownByNameAndRegion($name, $region) {
           
        $query = $this->getEntityManager()->createQuery('SELECT t FROM AppBundle\Entity\Town t WHERE t.name = :name  AND t.region = :region');
        $query->setParameters(array(
            'name' => $name,
            'region' => $region,
            
        ));
       
        return $query->getSingleResult();
    }

}
