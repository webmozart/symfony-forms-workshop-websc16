Implement a Form to Modify Contacts
===================================

Goal
----

We'll implement a similar form as in assignment 4 for modifying contacts. The
form should return a `ModifyContact` command, which we dispatch in the
controller.

This time, however, we also want to show the values of the modified `Contact`
instance in the form.

Tasks
-----

* Implement the `Contacts\Infrastructure\Web\Form\ModifyContactType`. You can
  copy large parts of the `ProposeContactType`. We'll learn how to reuse the
  code in the assignment 8
* In `mapDataToForms()`, expect that `$data` is a `Contact` instance and map
  the values of that contact to the fields
* Show the form in `ContactController::modifyAction()`. Pass the `Contact` to
  `$this->createForm()` to display its values in the form
* If the form is submitted successfully, dispatch the `ModifyContact` command 
  created by the form and redirect to the contact list
* Use `form(form)` to render the form. We'll learn how to reuse the HTML of
  the proposal form in assignment 9
  
Solution
--------

You can checkout the solution with:

    $ git checkout 06-split-input-output
