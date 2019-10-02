Service Project
========================

Welcome to the Service Project - this project contains the following features :

- A business directory is list of information on private or public companies. Businesses can be categorized by name, location or activity.

- Search engine of the users profile. profiles can be categorized by name, location, work , experience or activity.

- The User Management System provides functionality to manage users and personal profiles.

- Payment method for gold users.

- Resume Management.

Requirements
------------

  * PHP 7.1 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

### Step 1 : Clone the project

Now clone the project from github.

```bash
$ git clone https://github.com/Sfarii/symfony-service.git
```

### Step 2 : Install dependencies

Now that the project is cloned, running the following command should install all the symfony dependencies:

```bash
$ composer install
```

### Step 3 : Configuration

Now configure the .env file under project root.

### Step 4 : Run the project

Now run this command to run the built-in web server and access the application in your browser at <http://localhost:8000>:

```bash
$ php bin/console server:run
```

That's it.
