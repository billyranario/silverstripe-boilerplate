#!/bin/bash

# Check if the --prod argument is provided
if [ "$1" == "--prod" ]; then
    echo "Backing up current build"
    # Backup current version
    ssh root@170.64.135.121 'cp -r /home/mmp/htdocs/mmp.co.nz /home/mmp/htdocs/mmp.co.nz-backup'
    ssh root@170.64.135.121 chown -R mmp:mmp /home/mmp/htdocs/mmp.co.nz-backup

    echo "Deploying to production..."
    rsync -avL --exclude='.env' --exclude='public/assets' --exclude='.git' ./html/ root@170.64.135.121:/home/mmp/htdocs/mmp.co.nz
    ssh root@170.64.135.121 'cp /home/mmp/htdocs/mmp.co.nz/.env.prod /home/mmp/htdocs/mmp.co.nz/.env'
    ssh root@170.64.135.121 chown -R mmp:mmp /home/mmp/htdocs/mmp.co.nz
else
    echo "Deploying to staging..."
    # rsync -avL --exclude='.env' --exclude='public/assets' ./html/ root@170.64.135.121:/home/thehustle-mmp/htdocs/mmp.thehustle.nz
    # ssh root@170.64.135.121 chown -R thehustle-mmp:thehustle-mmp /home/thehustle-mmp/htdocs/southproperty.thehustle.nz
fi
