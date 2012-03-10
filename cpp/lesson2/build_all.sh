#!/bin/bash
for file in *.cpp
	do
		./compile.sh ${file%.cpp}
	done

