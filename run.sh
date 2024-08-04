#!/bin/bash

# Check the first argument
case "$1" in
  --build)
    # Build and start the containers
    docker-compose up -d --build

    # Wait for the build process to complete
    echo "Waiting for the build process to complete..."
    sleep 30

    # Check if html directory is created
    if [ -d "./html" ]; then
      echo "html directory exists."

      # Check if .env file already exists
      if [ -f "./html/.env" ]; then
        echo ".env file already exists. Skipping creation."
      else
        echo "Creating .env file inside html directory..."

        # Create .env file inside the html directory
        cat <<EOT > ./html/.env
SS_DATABASE_CLASS="MySQLDatabase"
SS_DATABASE_SERVER="db"
SS_DATABASE_USERNAME="billy"
SS_DATABASE_PASSWORD="password"
SS_DATABASE_NAME="appdb"
SS_ENVIRONMENT_TYPE="dev"
SS_DEFAULT_ADMIN_USERNAME="admin"
SS_DEFAULT_ADMIN_PASSWORD="admin"
EOT

        echo ".env file created inside html directory."
      fi
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
  *)
    # Default to starting the containers without building
    docker-compose up -d
    ;;
esac
