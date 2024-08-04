#!/bin/bash

# Check the first argument
case "$1" in
  --build)
    # Build and start the containers
    docker-compose up -d --build
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
