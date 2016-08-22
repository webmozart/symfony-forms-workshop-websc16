Implement a Form to Propose Contacts
====================================

Goal
----

Implement a form to propose contacts. We won't modify a `Contact` instance
directly, but create a `ProposeContact` command in the form which we'll
dispatch in the controller.

Tasks
-----

* Create the `Contacts\Infrastructure\Web\Form\ProposeContactType` class
* Show all fields of the `Contact` in the form except for the organization ID
* Let this type implement `DataMapperInterface` and create a new
  `ProposeContact` command in `mapFormsToData()`
* Display the form in `ProposalController::proposeAction()`
* If the form is submitted and valid, dispatch the command and redirect to the
  list of proposals
* Validate that the first and last name are set

Hints
-----

* You can leave `mapDataToForms()` empty
* Commands can be dispatched using `$this->get('command_bus')->handle($command)`

Solution
--------

You can checkout the solution with:

    $ git checkout 04-command-forms
