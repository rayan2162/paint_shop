# Paint Shop Management System

This is a Paint Shop Management System built with Laravel 10, Bootstrap 4, and Laravel/UI v4.x. It provides features to manage invoices, inventory, dues, and orders, along with user authentication and authorization for a simple yet effective paint shop workflow.

## Features

1. **Invoice Management**: Allows users to generate and print invoices with customer details and itemized products.
   ![Invoice Management Screenshot](/features_images/Invoice.png)

2. **Inventory Management**: Enables users to add, view, edit, and delete inventory items.
   ![Inventory Management Screenshot](/features_images/Inventory.png)

3. **Due Management**: Helps in tracking dues, adding, updating, and deleting due records.
   ![Due Management Screenshot](/features_images/Due.png)

4. **Order Management**: Facilitates the management of orders, with options to update the order status.
   ![Order Management Screenshot](/features_images/Orders.png)

## Prerequisites

- PHP >= 8.1
- Laravel 10
- Composer
- Node.js & npm
- MySQL or another supported database
- Laravel/UI

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/rayan2162/paint_shop.git
   cd paint-shop
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Set Up Environment**

   Copy `.env.example` to `.env` and update the database credentials and other configurations:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**

   Run the migrations to create necessary tables:

   ```bash
   php artisan migrate
   ```

5. **Run the Server**

   ```bash
   php artisan serve
   ```

   Your application should now be running at `http://127.0.0.1:8000`.

6. **Run the server** (Another method)
   Use this [laravel_server_start_srcipt](https://github.com/rayan2162/laravel_server_start_srcipt) for automatically starting the server and open the project in your browser

## Usage

### Authentication

- Users can register or log in.
- Authenticated users will have access to the main features (Invoice, Inventory, Due, and Orders).

### Managing Invoices

- Create a new invoice with customer details and an itemized list of purchased products.
- The total, paid, and due amounts are calculated automatically.

### Inventory Management

- Add new products with details such as product name, company name, quantity, buy price, sell price, and description.
- Edit or delete products as necessary.

### Due Management

- Record dues by adding customer information, due amount, and other details.
- Edit or delete existing due records.

### Order Management

- Add orders by specifying product name, company, quantity, and status.
- Update order status to track pending, shipped, or completed orders.

## Dependencies

- **Laravel**: PHP web framework
- **Bootstrap 4**: Front-end styling
- **Laravel/UI v4.x**: For authentication scaffolding

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
