# Laravel File Manager
Laravel File Manager is a comprehensive package for file management within Laravel applications. It provides an easy-to-use interface for uploading, saving, and deleting files with different extensions. This package seamlessly integrates with Laravel's file storage system, allowing you to store files in various locations, such as local disks or cloud storage services.

## Installation
To install the Laravel File Manager package, follow these steps:

### 1-Require the package using Composer:
```bash
composer require ahmadjabali/laravel-file-manager
```
### 2-Create a symbolic link from the storage folder to the public directory to access uploaded files:
```bash
php artisan storage:link
```
## Usage
The Laravel File Manager package provides a range of functionalities for file management. Here are some examples of common tasks:

### Uploading Files
To upload a file, you can use the upload method:
```php
productImage= ImageManager::upload('products/', 'png', $request->file('image'));
```

The upload method will store the file in the configured storage location and return the uploaded file name.

### Updating Files
To update a file, you can use the update method:
```php
$product->image = ImageManager::update('products/', $product['image'], 'png', $request->file('image'));
```

### Deleting Files
To delete a file, use the delete method:
```php
ImageManager::delete('/products/' . $product['image']);
```
The delete method will remove the specified file from the storage location.

## Security
Ensure that you validate user input and implement appropriate security measures when using the Laravel File Manager package. File uploads can pose security risks if not handled correctly. Verify the file type, sanitize file names, and limit file sizes to prevent potential vulnerabilities.

## Credits
The Laravel File Manager package is developed and maintained by [Ahmad Jabali](https://github.com/ahmadjabali). If you have any questions, suggestions, or issues, please feel free to open an issue on the [GitHub repository](https://github.com/ahmadjabali/laravel-file-manager).

## License
The Laravel File Manager package is open-source software licensed under the [MIT](https://pip.pypa.io/en/stable/) license.
