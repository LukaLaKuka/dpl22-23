#!/bin/bash

# Como este fichero lo guardaré en travelroad/src/run.sh por lo
# tengo que salir solamente hasta el nivel de travelroad
cd $(dirname $0)

./mvnw package

JAR = `ls target/*.jar -t | head -1`

/usr/bin/java -jar $JAR

