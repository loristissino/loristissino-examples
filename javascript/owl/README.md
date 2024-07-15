# The Owl experience

The [Odoo Web Library (Owl)](https://github.com/odoo/owl/tree/master) is a smallish UI framework built by [Odoo](https://www.odoo.com) for its products.
Owl is a modern framework, written in Typescript, taking the best ideas from React and Vue in a simple and consistent way.

Here I recap what I'm learning through my experiments.

## Lesson 1

We see that a single page can contain both the JS code and the XML template.
Including the owl minimized script is all you know to have the application running.

## Lesson 2

We see that the XML templates for the components can be placed in external files and fetched. This opens to some advantages, like having them stored in a database and served as needed, for instance. Since fetching files is possibile only when the applicazion is served by a web server, it is not possible to load the web page directly from the local filesystem: you need a local web server.

## Lesson 3

We move the app code in a separate JS file. From now on, we'll have an `app.xml` file for templates and an `app.js` file for the JavaScript code.

## Lesson 4

We begin to do something serious with templates. In the Root class we define an array of people and in the XML template we define a loop to show them in the page.

## Lesson 5

Here we have two arrays of items: not only some people, but also some cities. But the array of cities might be empty or not. The template has some logic that shows the list of cities or the message "No cities". The loop in the template takes also care of a counter that is used to show a different number for each city.

## Lesson 6

The XML file now contains a separate template for the representation of a person. It is used with the `t-call` attribute.

The code of the owlSetup() function is moved into an anonymous function that is defined in brackets and immediately calls itself. Much cleaner! (This could be used for the whole code of the application, by the way.)

## Lesson 7

We define a different component class for the representation of a person. The template is called now with the name of the component. The component has a list of "props", values that are passed by the caller.

## Lesson 8

The `Person` component has a method that handles the click on the name of the person represented. The `t-on-click` attribute is used to activate the event listener.

## Lesson 9

We add a `clickCount` prop to know how many times a person name has been clicked on. The prop is given the initial value 0 from the caller.

## Lesson 10

We introduce the concept of optional prop. Optional props can have a default values assigned in the class.

## Lesson 11

The magic begins. We use `clickCounter` instead of the `clickCount`. It is an object proxied by the framework via the `useState` feature of Owl. In the `increaseClickCounter` method we just take care of the application logic, because the view updates itself without us doing anything.


 
