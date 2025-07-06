# Project Top-Brands

## Features
- Dockerized Laravel + Vue application.
- Custom primary keys (e.g., `brand_id`) in migrations, models, and controllers.
- Robust JSON API error handling.
- Dynamic Vue.js component for the homepage.
- Database seeding for countries and brands.
- Toplist management per country with unique positions.
- API endpoints for toplist CRUD operations.

## API Endpoints
### Toplist Management
- `GET /countries/{country}/toplists` - Fetch toplist for a country.
- `PUT /countries/{country}/toplists` - Update toplist for a country (supports empty lists).
- `DELETE /countries/{country}/toplists` - Delete toplist for a country.

## Setup Instructions
### Prerequisites
- Ensure Docker and Docker Compose are installed on your system.
- Clone the repository:
  ```bash
  git clone git@github.com:noend/top-brand-list.git
  cd top-brand-list
  ```

### Setting Up the Application
1. Copy the `.env.example` file to `.env` and configure the environment variables:
   ```bash
   cp .env.example .env
   ```
2. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```
3. Install PHP dependencies using Composer:
   ```bash
   docker-compose exec app composer install
   ```
4. Install JavaScript dependencies using npm:
   ```bash
   docker-compose exec app npm install
   ```
5. Build the frontend assets:
   ```bash
   docker-compose exec app npm run build
   ```

### Running Migrations and Seeders
1. Run the database migrations:
   ```bash
   docker-compose exec app php artisan migrate
   ```
2. Seed the database:
   ```bash
   docker-compose exec app php artisan db:seed
   ```

### Accessing the Application
- Open your browser and navigate to `http://localhost:8080`.

### Additional Commands
- To stop the containers:
  ```bash
  docker-compose down
  ```
- To restart the containers:
  ```bash
  docker-compose restart
  ```
- To run tests:
  ```bash
  docker-compose exec app php artisan test
  ```

### Postman Collection

To simplify API testing, a Postman collection is provided.

#### Importing the Collection
1. Open Postman.
2. Click on the **Import** button in the top-left corner.
3. Select the provided `Top-Brands.postman_collection.json` file.
4. Click **Import** to add the collection to your workspace.

#### Using the Collection
- The collection includes pre-configured requests for all API endpoints.
- Use the requests to test the API endpoints directly from Postman.

### Authentication

To interact with protected API endpoints, you need to register a user and log in to obtain a Bearer token.

#### Registering a User
1. Use the `POST /register` endpoint to create a new user.
   - Example payload:
     ```json
     {
       "name": "John Doe",
       "email": "john.doe@example.com",
       "password": "password",
       "password_confirmation": "password"
     }
     ```

#### Logging In
1. Use the `POST /login` endpoint to log in with the registered user's credentials.
   - Example payload:
     ```json
     {
       "email": "john.doe@example.com",
       "password": "password"
     }
     ```
2. The response will include a `token` field. Copy this token.

#### Setting the Bearer Token
1. In Postman, go to the **Authorization** tab for the request.
2. Select `Bearer Token` as the type.
3. Paste the token into the input field.

Now you can access protected endpoints using the Bearer token.

### Protected Routes

All protected API routes require a Bearer token for authentication. 

To set the Bearer token in Postman:
1. Go to the **Authorization** tab for the request.
2. Select `Bearer Token` as the type.
3. Paste the token into the input field.

### Changing Toplist Order

To change the order of the toplist for a specific country, you need to include the `CF-IPCountry` header in your API requests. This header specifies the country code for which the toplist order should be updated.

#### Example
- Header:
  ```
  CF-IPCountry: BG
  ```

- For default toplist order, use the country code:

    ```    
    CF-IPCountry: XX
    ```

## Notes
- Ensure the database service is running before executing migrations or seeders.
- Use `php artisan` commands for additional management tasks.

