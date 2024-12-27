# **Laravel Todo App with Livewire**

A simple real-time Todo application built with the Laravel framework, Livewire components, and Bootstrap for styling. The app includes functionality to create, edit, delete, filter, and track todos dynamically, with real-time updates and a dynamic counter.

---

## **Features**

-   **Add Todos**: Users can add new tasks with proper validation.
-   **Edit Todos**: Update existing tasks in real time.
-   **Delete Todos**: Delete tasks with a confirmation box.
-   **Dynamic Counter**: Tracks and displays the count of completed and pending tasks.
-   **Filter Todos**: Filter tasks by "All", "Pending", or "Completed".
-   **Validation**: User input is validated for required fields and min & max length.

---

## **Requirements**

-   PHP >= 7.4
-   Composer
-   Laravel 8.x
-   Node.js & npm
-   MySQL or any supported database

---

## **Installation**

Follow these steps to set up and run the project:

### 1. Clone the Repository

```bash
git clone https://github.com/your-repo/laravel-todo-app.git
cd laravel-todo-app
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run dev
```

### 3. Set Up Environment

Copy the `.env.example` file to `.env` and configure your database settings:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run Migrations

Run the migrations to create the required tables in the database:

```bash
php artisan migrate
```

### 5. Seed the Database (Optional)

To populate the database with sample todos, you can use seeding:

```bash
#php artisan db:seed
```

### 6. Start the Server

Run the development server:

```bash
php artisan serve
```

The app will be accessible at `http://localhost:8000`.

---

## **Usage**

### Adding Todos

1. Enter the task in the input field.
2. Click the **"Submit"** button to add the task.

### Editing Todos

1. Click the **"Edit"** button next to the task.
2. Update the task in the input field and click **"Save"**.

### Deleting Todos

1. Click the **"Delete"** button next to the task.
2. Confirm the deletion in the left side modal.

### Filtering Todos

1. Use the radio buttons to filter tasks by:
    - **All**: Show all tasks.
    - **Pending**: Show only incomplete tasks.
    - **Completed**: Show only completed tasks.

### Dynamic Counter

The counter at the top dynamically updates to reflect:

-   **Completed Tasks**: Total tasks marked as done.
-   **Pending Tasks**: Total tasks yet to be completed.

---

## **Testing**

### Running Unit Tests

This project includes unit tests for the `TodoManager` component. Run the tests using:

```bash
php artisan test
```

Tests include:

-   Ensuring todos are saved correctly.
-   Validation errors for invalid input.
-   Proper updates to completed and pending tasks.

---

## **Tech Stack**

-   **Backend**: Laravel 8
-   **Frontend**: Livewire, Bootstrap 5
-   **Database**: MySQL (or any Laravel-supported database)
-   **Tools**: session flash notifications

---

## **Project Structure**

```
app/
├── Http/
│   ├── Livewire/
│   │   ├── TodoManager.php       # Manages todos
│   │   ├── TodoCounter.php       # Tracks counts
resources/
├── views/
│   ├── livewire/
│   │   ├── todo-manager.blade.php  # Todo Manager UI
│   │   ├── todo-counter.blade.php  # Counter UI
database/
├── migrations/                  # Database schema
tests/
├── Unit/
│   ├── TodoManagerTest.php       # Unit tests
```

---

## **Screenshots**

### Todo List Interface

![Todo List Interface](https://via.placeholder.com/800x400)

### Add/Edit Todo

![Add/Edit Todo](https://via.placeholder.com/800x400)

### Delete Confirmation

![Delete Confirmation](https://via.placeholder.com/800x400)

---

Enjoy building your tasks efficiently with the Laravel Todo App! 😊
