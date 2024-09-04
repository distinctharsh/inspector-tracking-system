# Inspector Tracking System

Inspector Tracking System (ITS) is a Laravel-based web application that provides role-based access control to manage inspectors. This system supports multiple user roles, including Admin, Manager, and User, with distinct permissions for each role.

## Table of Contents

```bash
Installation
Usage
Features
Technology Stack
Role & Permissions
File Structure
Contributing
License
Contact
```

## Installation

Follow the steps below to get the ITS project up and running on your local machine.



```python
# Clone the repository:
git clone https://github.com/your-username/its.git
cd its

# Install dependencies:
composer install
npm install

# Setup environment variables:
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password


# Add email credentials for email verification and password reset
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="admin@its.com"
MAIL_FROM_NAME="${APP_NAME}"

# Run database migrations and seeders:
php artisan migrate
php artisan db:seed
```

## Contributing

Contributions are welcome! If you have any suggestions or improvements, feel free to submit a pull request or open an issue.


## License

[MIT](https://choosealicense.com/licenses/mit/)
