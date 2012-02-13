#!/bin/bash

#if proxy is being used type: export http_proxy='http://proxy.com:8080/' 
#e.g. export http_proxy='http://localhost:8080/' 

wget  $1 -O tmp
egrep "[[:alnum:]+\.\_\-]+@[[:alnum:]]+[[:alnum:]+\.\_\-]*" -o tmp | sort | uniq > tmp2

