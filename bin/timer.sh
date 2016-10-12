#!/bin/bash

TIMELIMT=$1
SIZELIMIT=$2
USR_EXE=$3

LOCATION_EXE="./tmp/"

while true
do
	PID_EXE="$(ps -C $USR_EXE -o pid=)"
	if [ -z "$PID_EXE" ]
	then
		continue
	else
		break;
	fi
done

PID_RUNNER="$(ps -C runner.sh -o pid=)"

FLAG=0
while true
do
	TIME="$(ps -C $USR_EXE -o etimes=)"
	if [ "$TIME" -eq "$TIMELIMT" ]
	then
		FLAG=1
		break;
	fi
done

if [ "$FLAG" == 1 ]
then
	kill $PID_RUNNER
	kill $PID_EXE
	echo "TIME LIMIT EXCEEDED"
else
	echo "SUCCESSFULL"
fi




