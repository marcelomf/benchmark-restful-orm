#!/bin/bash
create()
{
	for i in $(seq 1 1000 | xargs echo); 
	do 
		curl -X POST -H "Content-Type: application/json" -d '{"username":"usuario'$i'","email":"usuario'$i'@usuario.com.br","password":"usuario'$i'"}' http://localhost:8015/user 
	done;

}

case "$1" in

	create)
    	create
      ;;

	reserach)
    	research
      ;;

	update)
		update
      ;;
    delete)
		delete
      ;;

   *)
      echo "Usage: stress.sh {create|research|update|delete}"
      exit 1
      ;;

esac
