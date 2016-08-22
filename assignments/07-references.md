Add a Field for Selecting an Organization
=========================================

Goal
----

So far, we cannot select or change the organization that a contact belongs to.
We'll fix that in this assignment.

Tasks
-----

* Create the class `Contacts\Infrastructure\Web\Form\OrganizationIdType`
* Let the class inherit `EntityType` (use the `getParent()` method)
* Set the `class` option to `Organization::class`
* Add the field `organizationId` of the new type to `ProposeContactType` and
  `ModifyContactType`
* The field returns an `Organization`, but we need the `OrganizationId`: Add
  a data transformer that transforms between the two
  
Example
-------

~~~php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    /** @var EntityManager $em */
    $em = $options['em'];

    $idToEntity = function ($value) use ($em) {
        // TODO: handle $value is null/not an OrganizationId

        return $em->find(Organization::class, $value);
    };

    $entityToId = function ($value) {
        // TODO: handle $value is null/not an Organization
        
        return $value->getId();
    };

    $builder->addModelTransformer(
        new CallbackTransformer($idToEntity, $entityToId)
    );
}
~~~
  
Hints
-----

* Use the `choice_label` option to control how an organization is rendered

Solution
--------

You can checkout the solution with:

    $ git checkout 07-references
