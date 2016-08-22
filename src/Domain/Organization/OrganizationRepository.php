<?php

namespace Contacts\Domain\Organization;

interface OrganizationRepository
{
    public function add(Organization $organization);

    /**
     * @param OrganizationId $id
     *
     * @return Organization
     */
    public function get(OrganizationId $id);

    /**
     * @param OrganizationId[] $ids
     *
     * @return string[]
     */
    public function findNames(array $ids);

    public function findAll();

    public function delete(OrganizationId $id);

    public function flush();
}
