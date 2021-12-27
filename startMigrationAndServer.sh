#!/bin/bash

#Run Composer
composer install

#Create final .env file
cp ./docker/.env.example ./.env

echo "First Run: ${FIRSTRUN}"
echo "Genearte Key: ${GENERATE}"
echo "Migrate: ${MIGRATE}"
echo "DB Seed: ${SEED}"
echo "Link: ${LINK}"

checkSuccess() {
    if [ $1 == 1 ]; then
        echo "Error code ${1}. Exiting..."
        exit 1
    fi
}

if [ x${FIRSTRUN} == "xyes" ]; then
    if [ x${GENERATE} == "xyes" ]; then
        echo "Generation Artisan Key"
        php artisan key:generate
        checkSuccess $?
    fi
    if [ x${MIGRATE} == "xyes" ]; then
        echo "Runnign Artisan Migrate"
        php artisan migrate
        checkSuccess $?
    fi
    if [ x${SEED} == "xyes" ]; then
        echo "Seeding DB"
        php artisan db:seed
        checkSuccess $?
    fi
    if [ x${LINK} == "xyes" ]; then
        echo "Artisan Creating Links"
        php artisan storage:link
        checkSuccess $?
    fi 
    echo "FIRSTRUN=no\nGENERATE=no\nMIGRATE=no\nSEED=no\nLINK=no" > /app/docker/.env-docker-realestate
fi


php artisan serve --host=0.0.0.0 --port=8000