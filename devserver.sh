#! /bin/sh

ht=public/.htaccess
host=$(grep ALUMNI_DATABASE_HOST $ht | awk '{print $3}')
user=$(grep ALUMNI_DATABASE_USER $ht | awk '{print $3}')
password=$(grep ALUMNI_DATABASE_PASSWORD $ht | awk '{print $3}')
database=$(grep ALUMNI_DATABASE_NAME $ht | awk '{print $3}')

export ALUMNI_DATABASE_HOST=$host
export ALUMNI_DATABASE_USER=$user
export ALUMNI_DATABASE_PASSWORD=$password
export ALUMNI_DATABASE_NAME=$database

php -S localhost:8000 -t public
