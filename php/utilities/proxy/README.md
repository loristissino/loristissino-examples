# A simple proxy

Sometimes pages served in https have javascript code that needs to 
access content served by unsecure servers.

If you place this file, for instance, in a directory called `proxy` on
your webserver, when the server receives a request like

    https://secure.example.com/proxy/?http://unsecure.example.com/books
    
it makes the unsecure connection to `http://unsecure.example.com/books`
and sends the content to the caller through a secure connection.

## Disclaimer

This is just an exercise and a way to solve a problem that I have to 
deal with sometimes when checking my students' exercises.

This is not meant as a professional way to get an unsecure resource. 
There are good reasons behind the fact that modern browesers do not 
allow an unsecure connection within a secure one.

Use it at your own risk.
