# Student Course Management System

This is a fullstack Laravel application that allows authenticated users to manage students, courses, and their enrollments.

## Core Features:
* **User Authentication:** Implemented using Laravel Breeze. Only authenticated users can access the dashboard and core functionalities.
* **CRUD for Students:**
    * Database Fields: `name`, `email`, `gender`, `date_of_birth`, `address`
    * Routes: `/students`, `/students/create`, `/students/{id}/edit`
* **CRUD for Courses:**
    * Database Fields: `course_code`, `course_name`, `description`, `unit`
    * Routes: `/courses`, `/courses/create`, `/courses/{id}/edit`
* **Course Enrollment:**
    * Allows assigning students to multiple courses (many-to-many relationship).
    * Routes: `/enrollments`, `/enrollments/create`, `/enrollments/{id}/edit`
    * Displays students with their list of enrolled courses.

## Frontend:
* Uses Laravel Blade templates.
* Styled with **Tailwind CSS** for a responsive and modern look.
* Includes Laravel validation for all forms.
* Displays success and error messages using flash sessions.

## Database Design:
* `users`
* `students`
* `courses`
* `course_student` (pivot table for many-to-many relationship)

## Setup Instructions:

Follow these steps to get the project up and running on your local machine.

### Prerequisites:
* Install Herd
* PHP >= 8.1
* Composer
* Node.js & npm (or Yarn)
* A database (MySQL, PostgreSQL, SQLite, etc.)

### Installation Steps:

1.  **Clone the repository:**
    ```
    inside the Herd directory run 
    git clone https://github.com/Coolhands-frank/student-course-management-system.git
    cd student-course-management
    ```

2.  **Install Composer dependencies:**
    Make sure PHP and NGINX services are running in Herd
    ```
    composer install
    ```

3.  **Copy the environment file:**
    ```
    cp .env.example .env
    ```

4.  **Generate an application key:**
    ```
    php artisan key:generate
    ```

5.  **Configure your database:**
    Use SQLite (easiest with Herd)
    In .env, update:

    ```
    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/database/database.sqlite
    ```
    Then, create the database file:
    ```
    mkdir database
    touch database/database.sqlite
    ```

    if using MySQL or Postgres
    update `.env` file with your DB settings. For example, for MySQL:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=student_cms_db # Choose a name for your database
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Make sure to create the database (`student_cms_db` or your chosen name) in your database server.

6.  **Run database migrations and seeders:**
    ```
    php artisan migrate --seed
    ```
    This creates all the necessary tables (`users`, `students`, `courses`, `course_student`) and inserts initial data.

7.  **Install Node.js dependencies and compile assets:**
    ```
    npm install
    npm run dev
    ```

8.  **Run the application:**
    ```
    php artisan serve
    ```
    The application will typically be available at `http://127.0.0.1:8000`.

    Or if you're using Herd, just go to:
    ```
    http://student_course_management_system.test
    ```
    Herd sets this domain up automatically based on the folder name.

### Usage:

1.  Register a new user through the `/register` route.
2.  Log in with the registered user.
3.  Navigate to the Dashboard, Students, Courses, or Enrollments sections using the navigation bar.
4.  Perform CRUD operations for Students and Courses.
5.  Manage course enrollments by assigning courses to students.