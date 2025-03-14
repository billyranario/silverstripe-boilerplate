
# SilverStripe Boilerplate Project For Docker

This repository contains Boilerplate for the SilverStripe project.

## Getting Started

### Prerequisites

Make sure you have the following installed on your machine:
- Docker
- Docker Compose
- Node.js and npm

### Cloning the Repository

Clone the repository using the following command:

```bash
git clone git@github.com:billyranario/silverstripe-boilerplate.git
cd silverstripe-boilerplate
```

### Building the Project

Navigate to the project root where the `docker-compose.yml` file is located and build the project for the first time:

```bash
./run.sh --build
```
Adding `--build` flag will create a .env file for the project.

### Running the Project

If the project is already built, you can start it using:

```bash
./run.sh
```

### Stopping the Project

To stop and remove the Docker containers, run:

```bash
./run.sh down
```

## Additional Setup

### Installing npm Packages

Navigate to the `html/` directory and run:

```bash
cd html/
npm install
```

### Running Composer Commands

If you need to run Composer commands inside the PHP container, use the following command to access the container:

```bash
docker exec -it app-server bash
```

Once inside the container, you can run Composer commands as needed:

```bash
composer install
```

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

- [SilverStripe](https://www.silverstripe.org/)
- [Docker](https://www.docker.com/)
- [Node.js](https://nodejs.org/)

For any questions or issues, please contact the repository owner.
