Create a CRUD for Organizations
===============================

Goal
----

Add a CRUD for `Organization`. It should be possible to create
and modify organizations in the UI.

Tasks
-----

* Create the `Contacts\Infrastructure\Web\Form\OrganizationType` class
* Set the `data_class` option of the type to `Organization::class`
* Only show the `name` field and the submit button `submit`. We'll follow up 
  with `email`, `phoneNumber` and `address` in later assignments
* Complete `createAction()` and `editAction()` in the `OrganizationController`.
  After a successful submission, redirect to the organization list
* Complete the `organization/create.html.twig` and `organization/edit.html.twig`
  templates
* Validate that the name is not empty. If you want, set a custom error message

Hints
-----

* Check the 
  [Symfony documentation](http://symfony.com/doc/current/components/form.html)
  for example forms
* Use the `empty_data` option for creating a new `Organization`
* Use `form(form)` to render the form in the template (for now)
* Use `OrganizationRepository::add()` for adding new organizations and
  `OrganizationRepository::flush()` for updating existing ones
* Use the `constraints` option for validating the name
* You can test whether the server-side validation works by entering only
  spaces. This will circumvent the browser's own validation

Solution
--------

You can checkout the solution with:

    $ git checkout 01-crud
