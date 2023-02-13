#!/bin/bash

# Como este fichero lo guardaré en travelroad/src/run.sh por lo
# tengo que salir solamente hasta el nivel de travelroad
cd $(dirname $0)

./mvnw package

cd ..

JAR = `ls target/*.jar -t | head -1`

nice -n 19 /usr/bin/java -jar $JAR

