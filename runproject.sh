#!bin/bash

sudo composer -update; composer upgrade; composer du -o

sudo service nginx reload