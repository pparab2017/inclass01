#!/bin/bash

#force the git pull
git pull
git fetch --all
git reset --hard origin/master
git pull origin master