#!/bin/bash

# Check if the --prod argument is provided
if [ "$1" == "--prod" ]; then
    # echo "Deploying to production..."
    # rsync -avL --exclude='.env' --exclude='public/assets' ~/Projects/The_Hustle/SouthProperty/south-property-silverstripe/html/ root@170.64.171.140:/home/thehustle-southproperty/htdocs/southproperty.co.nz
    # ssh root@170.64.171.140 chown -R southproperty:southproperty /home/thehustle-southproperty/htdocs/southproperty.co.nz
else
    # echo "Deploying to staging..."
    # rsync -avL --exclude='.env' --exclude='public/assets' ~/Projects/The_Hustle/SouthProperty/south-property-silverstripe/html/ root@170.64.171.140:/home/thehustle-southproperty/htdocs/southproperty.thehustle.nz
    # ssh root@170.64.171.140 chown -R thehustle-southproperty:thehustle-southproperty /home/thehustle-southproperty/htdocs/southproperty.thehustle.nz
fi
