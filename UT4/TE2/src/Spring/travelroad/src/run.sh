#!/bin/bash

cd $(dirname $0)

./mvnw package

cd ..

JAR = `ls target/*.jar -t | head -1`

nice -n 19 /usr/bin/java -jar $JAR