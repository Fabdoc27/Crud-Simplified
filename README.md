# Getting Started

Follow these steps to set up the project:

1. **Clone the repository and navigate to the directory:**

    ```shell
    git clone git@github.com:Fabdoc27/Crud-Simplified.git
    cd Crud-Simplified
    ```

2. **Install the dependencies:**

    ```shell
    composer install
    npm install
    ```

3. **Create the environment file:**

    ```shell
    cp .env.example .env
    ```

4. **Generate the application key:**

    ```shell
    php artisan key:generate
    ```

5. **Run the database migrations and seed the database:**

    ```shell
    php artisan migrate --seed
    ```

6. **Start the development server:**

    ```shell
    npm run dev
    php artisan serve
    ```
