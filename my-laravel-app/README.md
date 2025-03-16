# My Laravel App

## Overview
This is a Laravel application designed to manage categories and their relationships with articles. It provides a command-line interface for editing categories, as well as a web interface for managing them.

## Features
- Create, update, and delete categories.
- Edit categories using an Artisan command.
- Manage relationships between categories and articles.

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd my-laravel-app
   ```
3. Install dependencies:
   ```
   composer install
   npm install
   ```
4. Set up your environment file:
   ```
   cp .env.example .env
   ```
5. Generate the application key:
   ```
   php artisan key:generate
   ```
6. Run migrations:
   ```
   php artisan migrate
   ```

## Usage
To edit categories, you can use the following Artisan command:
```
php artisan edit:categories
```

## Testing
To run the tests for the application, use:
```
php artisan test
```

## License
This project is licensed under the MIT License.