#!/bin/bash
create()
{
dirs=$(ls -l -d public/js/* | egrep '^d' | awk -F" " '{ print $9  }' | xargs echo)
	for dir in $dirs
	do
		bundle=$(echo $dir | cut -d'/' -f3);
		echo "Creating link public_js for: "$bundle
		ln -s ../../public/js/$bundle bundles/$bundle/public_js
	done;
}

case "$1" in

	create)
		create
      ;;

   *)
      echo "Usage: ofmlinks.sh {create}"
      exit 1
      ;;

esac
