<?php

namespace Tactics\Bundle\FormBundle\Autocomplete;

use Doctrine\Common\Persistence\ObjectManager;

class DefaultAutocomplete
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->setManager($manager);
    }

    /**
     * Function to replace the default manager (in case the entity is not in the default entity manager)
     *
     * @param ObjectManager $manager
     * @return $this
     */
    public function setManager(ObjectManager $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Queries the database for the given term and property or array of properties
     *
     * @param string $class
     * @param string $term
     * @param string|array $properties
     * @param int $maxResults
     * @return array
     */
    public function autocomplete($class, $term, $properties, $maxResults = 10)
    {
        if (! is_array($properties)) {
            $properties = array($properties);
        }

        $qB = $this->manager->getRepository($class)
            ->createQueryBuilder('e');

        $orX = $qB->expr()->orX();
        foreach ($properties as $property) {
            $orX->add($qB->expr()
                ->like('e.'.$property, $qB->expr()
                    ->literal('%'.$term.'%')
                )
            );
        }

        return $qB->where($orX)
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult()
        ;
    }
}