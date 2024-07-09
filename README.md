## Overview

This project is simple PHP web application that allows you to manage and display articles. It includes the following features:

	•	Show list of articles
	•	Display single article
	•	Create new article
	•	Update article
	•	Delete article
	•	Like an article
	•	Leave a comment on an article
	•	Display comments under an article
	•	Delete a comment
	•	Like a comment

The project is styled using TailwindCSS and utilizes Monolog for logging. Dependency injection is implemented using PHP-DI.

## Requirements

- PHP >= 7.4  
- Composer (for dependency management)

### Installation

1.	Clone the repository:
```bash
git clone git@github.com:ievasinke/blog-app.git
cd blog-app
```

2.	Install dependencies:
```bash
composer install
```

3.	Set up the database:
This project uses an SQLite database. To create the database schema, run the following script:
```bash
php setup.php
```

Running the Application

To start the application, run:
```bash
php -S localhost:8000
```

Then open your browser and go to http://localhost:8000