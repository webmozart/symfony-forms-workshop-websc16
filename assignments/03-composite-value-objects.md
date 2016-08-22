Add a Form Type for the Address
===============================

Goal
----

In the previous assignment, we made value objects editable that contain a 
single value. In this assignment, we'll add a form type for the value object 
`Address`, which consists of multiple fields.

Tasks
-----

* Create the type `Contacts\Infrastructure\Web\Form\AddressType`
* Add the fields `name`, `postalCode`, `city` and `countryCode` and choose
  appropriate types. None of the fields is required
* Let `AddressType` implement `DataMapperInterface` to map the `Address` to
  the fields and back
* Add a field `address` of type `AddressType` to the `OrganizationType`
* Make sure the type works with empty addresses (i.e. if the address of the 
  organization is `null`)
* Make sure the type returns `null` if all fields are empty. Use
  `$forms['street']->isEmpty()` to figure out if a field is empty
  
Example
-------

~~~php
class AddressType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ... add fields ...
            ->setDataMapper($this)
        ;
    }

    public function mapDataToForms($data, $forms)
    {
        $forms = iterator_to_array($forms);

        // call setData() on each form
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        // update $data
    }
}

~~~

Hints
-----

* **Attention:** `$data` is an in-out parameter in `mapFormsToData()`. You must
  change the value of the variable, not return the value!
* See [this blog post](https://webmozart.io/blog/2015/09/09/value-objects-in-symfony-forms/)
  for examples

Solution
--------

You can checkout the solution with:

    $ git checkout 03-composite-value-objects
