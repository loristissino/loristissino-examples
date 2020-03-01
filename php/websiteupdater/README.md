# Very simple website updater

If you manage your project with git and your only possibility to update
the website via a php script, this thing could be a solution.

Basically, after every git commit, you use the client script from the
command line, like this:

	php website_updater.php _commit-id_
	
This script executes `git diff-tree` and obtains a list of the added or
modified files, generates a json file with the contents of these files,
and sends them on POST request to the script on the server.

Of course, you shoud configure the script to set the path of the remote
script.

The server script receives the JSON file, decodes it and writes / 
overwrites the files, creating the directory if neeeded.

The server-side script should have a non-guessable name, since there is
no extra-security. Add your own rules if you want to add extra-security.

Use at your own risk.
