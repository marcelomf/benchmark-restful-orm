#!/bin/bash
startGraoJS()
{
	#sudo service mongod start
	#sudo service nginx start
	sudo node ./.././index.js > ./../log/grao.log 2>&1 &
	tail -f ./log/grao.log
}

stopGraoJS()
{
	sudo service mongod stop
	#sudo service nginx stop
	ps -ax | grep node | grep grao | cut -d' ' -f1 | xargs echo | xargs sudo kill -9
}

restartGraoJS()
{
	stopGraoJS
	startGraoJS
}

case "$1" in

   start)
    startGraoJS
      ;;

   stop)
      stopGraoJS
      ;;

   restart)
	 restartGraoJS
      ;;

   *)
      echo "Usage: grao.sh {start|stop|restart|}"
      exit 1
      ;;

esac
