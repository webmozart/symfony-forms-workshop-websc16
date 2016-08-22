Introduction
============

Welcome to the Symfony Forms workshop!

The goal of this workshop is to give you an idea how to use the Symfony Form 
component in a Domain-Driven Design (DDD). I won't go into the depths of
explaining DDD itself, but here are some basics:

* The focus of DDD is the customer's business. Core concepts are modeled in
  the application and named after the Ubiquitous Language – a terminology
  shared by customers, project managers, developers and everyone else on the
  project.
  
* The domain is modeled in terms of Aggregates. One aggregate is a collection
  of objects that are consistent within the aggregate. One object is the entry
  point to the aggregate: The Aggregate Root. Only the aggregate root may be
  referenced from outside the aggregate.
  
  An example aggregate is Order, where the Order class is the aggregate root
  and LineItem is another object in the aggregate. The total of the order
  equals the sum of the line item amounts. Hence the objects are consistent
  within the aggregate's boundaries.
  
* The application is layered. At the core is the Domain layer. The Domain layer
  is encapsulated by the Application layer, which translates commands from the
  outside and executes them on the model. The Application layer is further
  encapsulated by the Infrastructure layer, which connects different
  technologies with the application: a database, a messaging system, the web
  server, an REST API, and so forth. This "onion"-shaped architecture is also
  called Hexagonal Design or Ports and Adapters: The application has input and
  output ports that are connected to different technologies (database, web
  server, mailing system etc.) through adapters.
  
The example application of this workshop is a Customer Relationship Management
system, or CRM. Our business experts say:

* Proposers talk to customers on the phone, via email and at exhibitions. If 
  they think that a customer should be followed up upon, they propose the
  contact to be tracked in the CRM. They can only see contacts that they
  proposed themselves.
  
* Managers check the contact database for integrity. They verify new contact
  proposals and approve or reject them. They also merge duplicate contacts in 
  order to avoid tracking information about the same customer in different
  places of the system. Contacting the customer twice in the same matter could
  be dangerous to the business and needs to be avoided.
  
* Managers also manage the organizations that contacts belong to. If an
  organization has incorrect data, they correct it. Proposers either
  select an existing organization from a list or type the name of a new
  organization if it is missing. They usually do not provide any other
  information about an organization.

The system contains the following aggregates:

* **Contact** represents a single contact with all of its fields. A contact 
  contains value objects such as Email or Address.

* **Organization** represents a single organization. Like Contact, it contains 
  value objects only.

The Contact aggregate models a workflow, where contacts are proposed, then
either approved or rejected, and subsequently modified and potentially merged
with other contacts. These actions are exposed through Command objects in the
Application layer to the outside world.

The Organization aggregate does not model any specific workflow. It is a very
simple entity that represents an organization's known contact information.

You can explore the application UI in [http://forms.websc](http://forms.websc).
    
Continue with assignment 1 if you're ready to start.
