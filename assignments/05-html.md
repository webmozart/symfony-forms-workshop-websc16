Customize the Form HTML
=======================

Goal
----

We relied on the `form(form)` function for rendering the form. Let's customize
the HTML of the proposal form:

* We'll change the order of the fields
* We'll add fieldsets around some fields
* We'll enable a datepicker on the date field

Tasks
-----

* Use `form_start(form)` and `form_end(form)` to render the opening and closing
  HTML tags of the form along with extra markup (for CSRF protection and
  emulation of PUT requests)
* Use `form_row(form.field)` to render each field
* Skip the nesting level of the `address` field by directly rendering
  `form_row(form.address.street)` etc.
* Change the label of the "Country code" field to "Country"
* Change the label of the "Submit" field to "Propose"
* Wrap a fieldset with the legend "Contact Information" around the fields
  `email`, `phoneNumber`, `street`, `postalCode`, `city` and `countryCode`
* Wrap a fieldset with the legend "Additional Information" around the field 
  "Notes"
* Pass the class `bootstrap-datepicker` to the `dateOfBirth` field to activate
  the datepicker

Hints
-----

* You can change the label of a field by passing the `label` option to
  `form_row()`, e.g. `form_row(form.address.countryCode, {'label': 'Country'})`
* You can set any HTML attribute, such as `class`, by passing the `attr` option 
  to `form_row()`, e.g.
  `form_row(form.dateOfBirth, {'attr': {'class': 'bootstrap-datepicker'}})`
* To make the datepicker work, you need to change the `dateOfBirth` field in
  `ProposeContactType`:
   * set the option `widget` to `single_text`
   * set the option `format` to `d/M/y` 

Solution
--------

You can checkout the solution with:

    $ git checkout 05-html
