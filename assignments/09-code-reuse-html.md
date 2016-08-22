Reuse HTML Code
===============

Goal
----

Last but not least, we'd like to reuse the HTML code of `ProposeContactType`
in `ModifyContactType`.

Tasks
-----

* Move the common code to a file `form.html.twig`
* Include that file in the proposal and the modification forms
* Set the label of the submit button to "Propose" in the proposal form and
  "Modify" in the modification form
  
Hints
-----

* You can pass variables in the second argument of `include()`

Solution
--------

You can checkout the solution with:

    $ git checkout 09-code-reuse-html
