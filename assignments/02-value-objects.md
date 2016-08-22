Add Form Types for Email and PhoneNumber
========================================

Goal
----

Both the email and the phone number of the `Organization` are modeled as value 
objects, namely `Email` and `PhoneNumber`. Let's add fields to change those 
value objects.

Tasks
-----

* Create the `Contacts\Infrastructure\Web\Form\PhoneNumberType` class
* Let `PhoneNumberType` inherit `TextType` by returning `TextType::class` from
  its `getParent()` method
* Let the type implement `DataTransformerInterface` to convert `PhoneNumber` 
  to a string and back and use it as model transformer
* Throw a `TransformationFailedException` if you're unable to transform a value
* Add the field `phoneNumber` of type `PhoneNumberType::class` to the
  `OrganizationType` of the last assignment
* The field is optional. Make sure it can be submitted without a value
  
Example
-------

~~~php
class PhoneNumberType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }
    
    public function getParent()
    {
        return TextType::class;
    }
    
    public function transform($value)
    {
        // convert PhoneNumber/null to string/null
    }
    
    public function reverseTransform($value)
    {
        // convert string/null to PhoneNumber/null
    }
}
~~~
  
Bonus Task (optional)
---------------------

* Repeat these steps for the `email` field and create a new `EmailType`
* Let this type extend Symfony's own `EmailType` to automatically render it
  as HTML5 email field
* Validate that the value is an email address. To do so, set the `constraints` 
  option in `EmailType::configureOptions()`
  
Hints
-----

* If you get an error during rendering, implement `EmailType::getBlockPrefix()` 
  and return the string `custom_email`. This prevents naming collisions with
  Symfony's own `EmailType`
  
Solution
--------

You can checkout the solution with:

    $ git checkout 02-value-objects
