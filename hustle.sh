#!/bin/bash

# Function to show a progress bar
show_progress() {
  duration=$1
  already_done() { for ((done=0; done<$elapsed; done++)); do printf "#"; done }
  remaining() { for ((remain=$elapsed; remain<$duration; remain++)); do printf "-"; done }
  percentage() { printf "| %s%%" $(( ($elapsed*100)/$duration )); }

  for ((elapsed=1; elapsed<=$duration; elapsed++))
  do
    already_done; remaining; percentage
    printf "\r"
    sleep 1
  done
  printf "\n"
}

# Check the first argument
case "$1" in
  --build)
    # Build and start the containers
    docker-compose up -d --build

    # Show progress bar for 30 seconds
    echo "Waiting for the build process to complete..."
    show_progress 30

    # Check if html directory is created
    if [ -d "./html" ]; then
      echo "html directory exists."

      # Copy .env file if not exists
      if [ -f "./html/.env" ]; then
        echo ".env file already exists. Skipping copy."
      else
        echo "Copying .env file from config to html directory..."
        cp ./config/.env ./html/.env
        echo ".env file copied to html directory."
      fi

      # Copy package.json file if not exists
      if [ -f "./html/package.json" ]; then
        echo "package.json file already exists. Skipping copy."
      else
        echo "Copying package.json file from config to html directory..."
        cp ./config/package.json ./html/package.json
        echo "package.json file copied to html directory."
      fi

      # Copy app/_config/theme.yml and override if exists
      echo "Copying theme.yml from config to html directory..."
      mkdir -p ./html/app/_config
      cp ./config/app/_config/theme.yml ./html/app/_config/theme.yml
      echo "theme.yml copied to html directory."

      # Copy app/_config/elements.yml and override if exists
      echo "Copying elements.yml from config to html directory..."
      mkdir -p ./html/app/_config
      cp ./config/app/_config/elements.yml ./html/app/_config/elements.yml
      echo "elements.yml copied to html directory."

      # Copy the rest of the config directory structure
      rsync -a ./config/themes/ ./html/themes/
      rsync -a ./config/app/ ./html/app/
      cp ./config/postcss.config.js ./html/postcss.config.js
      cp ./config/tailwind.config.js ./html/tailwind.config.js

      # Run npm install if package.json was copied
      if [ ! -d "./html/node_modules" ]; then
        echo "Running npm install..."
        cd ./html
        npm install
        cd ..
        echo "npm install completed."
      fi

      # Build CSS before dev/build
      echo "Running npm run build:css..."
      cd ./html
      npm run build:css
      cd ..
      echo "npm run build:css completed."

      # Run composer require to add necessary packages
      echo "Running composer require to add necessary packages..."
      docker-compose exec php composer require \
        dnadesign/silverstripe-elemental:^5.2 \
        dnadesign/silverstripe-elemental-userforms:^4.1 \
        undefinedoffset/sortablegridfield:^2.2 \
        undefinedoffset/silverstripe-nocaptcha:^2.4 \
        silverstripe/tagfield:^3.2 \
        sendgrid/sendgrid:^8.1
      echo "Composer packages installed."

      # Run dev/build flush
      echo "Running dev/build flush..."
      docker-compose exec php vendor/bin/sake dev/build flush=1
      echo "dev/build flush completed."

      # Run composer vendor-expose
      echo "Running composer vendor-expose..."
      docker-compose exec php composer vendor-expose
      echo "composer vendor-expose completed."

    else
      echo "html directory not found. Please check the build process."
    fi
    ;;
  down)
    # Check for second argument to remove volumes
    if [[ "$2" == "-v" ]]; then
      # Take down the containers and remove volumes
      docker-compose down -v
      echo "Removing volumes..."
    else
      # Take down the containers normally
      docker-compose down
    fi
    ;;
  up)
    # Default to starting the containers without building
    docker-compose up -d
    ;;
esac
