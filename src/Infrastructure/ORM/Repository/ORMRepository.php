<?php

namespace Contacts\Infrastructure\ORM\Repository;

use Contacts\Infrastructure\Framework\NoResult;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use RuntimeException;

class ORMRepository extends EntityRepository
{
    public function flush()
    {
        $identityMap = $this->_em->getUnitOfWork()->getIdentityMap();

        if (isset($identityMap[$this->getClassName()])) {
            $this->_em->flush($identityMap[$this->getClassName()]);
        }
    }

    protected function doAdd($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush($entity);
    }

    protected function doGet($id)
    {
        $entity = $this->find($id);

        if (null === $entity) {
            throw NoResult::forId($id);
        }

        return $entity;
    }

    protected function doDelete($id)
    {
        $reference = $this->_em->getReference($this->getClassName(), $id);

        try {
            $this->_em->remove($reference);
            $this->_em->flush($reference);
        } catch (EntityNotFoundException $e) {
            $this->_em->detach($reference);
        }
    }
}
