# Project Name

Describe your project briefly here. Mention what it does and its main features.

## Getting Started

These instructions will get your project up and running on your local machine for development and testing purposes.

### Prerequisites

- PHP >= 7.3
- Composer
- A web server like Apache or Nginx
- MySQL or any Laravel-supported database system
- Postman or any API testing tool

### Installing

#### Step 1: Clone the Repository

Clone this repository to your local machine.

```bash
git clone https://github.com/arifur9993/rtb-bid-request.git
cd project
```

#### Step 2: Install Dependencies

Run Composer to install the necessary PHP dependencies.

```bash
composer install
```

#### Step 3: Environment Configuration

Copy the example environment file and make the necessary configuration adjustments specific to your environment.

```bash
cp .env.example .env
```

Edit .env to set your database and other environment variables.

#### Step 4: Generate Application Key
Generate a unique application key with Artisan.

```bash
php artisan key:generate
```
#### Step 5: Run Migrations
Migrate your database to create the necessary tables.

```bash
php artisan migrate
```

#### Step 6: Seed the Database
Seed your database for Campains Data


```bash
php artisan db-seed
```
Testing the API
To test the /bid-request endpoint, you can use Postman or any similar API testing platform.

Using Postman

** Open Postman.
** Create a new request.
** Set the method to POST.
** Enter the request URL (e.g., http://yourlocaldevenvironment.com/api/bid-request).
** In the Headers section, add:
** Key: Content-Type, Value: application/json
** In the Body section, select raw and paste your bid request JSON.
** Send the request and observe the response.
** You can use the bid request body as the provied example data for bid request

Running Tests
To run the automated tests for this project, use the following command:

```bash
php artisan test
```


#### Built With
Laravel - The web framework used


#### Contributing
Please read CONTRIBUTING.md for details on our code of conduct, and the process for submitting pull requests to us.

#### Authors
Md. Arifur Rahman


#### License
This project is licensed under the MIT License - see the LICENSE.md file for details.
