Reduce Code Duplication in the Form Types
=========================================

Goal
----

Our `ProposeContactType` and our `ModifyContactType` share quite a bit of code.
We'll move that code to a common class to remove the duplication.

Tasks
-----

* Create a new `Contacts\Infrastructure\Web\Form\GenericContactType` that will
  house the common code
* Let `ProposeContactType` and `ModifyContactType` inherit that type
  (use `getParent()`)
* Move as much of the `buildForm()` code to `GenericContactType::buildForm()`
  as you can
  
Hints
-----

* Since you are using the special inheritance mechanism of the Form component,
  you don't need to call `parent::buildForm()` manually. In fact, that doesn't
  make sense, since `parent` refers to `AbstractType` - where that method is
  empty. The Form component takes care of calling the `buildForm()` method of
  the parent type automatically.

Solution
--------

You can checkout the solution with:

    $ git checkout 08-code-reuse-form
