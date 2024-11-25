# Magento 2 Admin Password CLI

[![Latest Stable Version](https://img.shields.io/packagist/v/custom/module-admin-password-cli.svg)](https://packagist.org/packages/custom/module-admin-password-cli)
[![Total Downloads](https://img.shields.io/packagist/dt/custom/module-admin-password-cli.svg)](https://packagist.org/packages/custom/module-admin-password-cli)
[![License](https://img.shields.io/packagist/l/custom/module-admin-password-cli.svg)](https://packagist.org/packages/custom/module-admin-password-cli)

A Magento 2 module that provides a secure CLI command to change admin user passwords, particularly useful when multiple admin users share the same username. This module adds an extra layer of security by requiring email verification during the password change process.

## Features

- 🔐 Secure password changing via CLI
- ✉️ Email verification to identify the correct admin user
- 👥 Handles multiple users with the same username
- 🛡️ Input validation and error handling
- 📝 Detailed success/error messaging

## Requirements

- Magento 2.3.x, 2.4.x
- PHP 7.4 or higher

## Installation

### Using Composer (Recommended)

```bash
composer require kryptalabs/module-admin-password-cli
bin/magento module:enable Kryptalabs_AdminPasswordCli
bin/magento setup:upgrade
bin/magento cache:flush
```

### Manual Installation

1. Create the following directory structure in your Magento installation:
   ```
   app/code/Kryptalabs/AdminPasswordCli/
   ```

2. Download the module and copy the contents to the directory.

3. Enable the module:
   ```bash
   bin/magento module:enable Kryptalabs_AdminPasswordCli
   bin/magento setup:upgrade
   bin/magento cache:flush
   ```

## Usage

The module adds a new CLI command to change admin passwords:

```bash
bin/magento admin:user:password:change -u admin_username -p new_password -e admin_email
```

### Command Options

| Option      | Short | Required | Description           |
|-------------|-------|----------|-----------------------|
| --username  | -u    | Yes      | Admin username        |
| --password  | -p    | Yes      | New password         |
| --email     | -e    | Yes      | Admin email address  |

### Examples

Change password for a specific admin user:
```bash
bin/magento admin:user:password:change --username adminuser --password newPassword123 --email admin@example.com
```

Using short options:
```bash
bin/magento admin:user:password:change -u adminuser -p newPassword123 -e admin@example.com
```

## Error Handling

The command includes comprehensive error handling for various scenarios:

- Missing required options
- User not found
- Email mismatch
- Invalid password format
- Database errors

## Security

- Passwords are securely hashed using Magento's native password hashing mechanism
- Email verification prevents unauthorized password changes
- CLI-only access adds an extra layer of security

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Support

If you encounter any issues or have questions, please:

1. Check the [Issues](https://github.com/divyesh-thadani/magento2-admin-password-cli/issues) page
2. Submit a new issue if your problem isn't already listed
3. For urgent support, contact [divyesh@kryptalabs.com]

## Author

Your Name
- GitHub: [@divyesh-thadani](https://github.com/divyesh-thadani)
- Email: divyesh@kryptalabs.com

## Changelog

### 1.0.0
- Initial release
- Basic password change functionality
- Email verification feature
- Error handling implementation

---
⭐ Found this useful? Show your support by giving this repository a star on [GitHub](https://github.com/yourusername/magento2-admin-password-cli)!
