#!/bin/bash
rm -rf docs/phpdoc
phpdoc -d . -t docs/phpdoc -dn PhotoAlbum
cd docs
zip -r phpdoc.zip phpdoc

