# Very simple website updater

If you manage your project with git and your only possibility to update
the website via a php script, this thing could be a solution.

Basically, after every git commit, you use the client script from the
command line, like this:

	php website_updater.php commit-id
	
The client script:

1) executes `git diff-tree` and obtains a list of the added, 
modified or deleted files;

2) generates a json file with the contents of these files;

3) send the json file with a POST request to the script on the server.

All files are base64-encoded, so it is binary safe.

Of course, you shoud configure the script to set the path of the remote
script.

The server script:

1) receives the JSON file;

2) decodes it;

3) writes / overwrites / deletes the files, creating the directories 
when neeeded.

Files removed (with `git rm`) are deleted from the server.

The server-side script should have a non-guessable name, since there is
no extra-security. Add your own rules if you want to add extra-security.

The client-side script can be easily transformed to be used without git.
Just read the comments in the source.

Use at your own risk.
