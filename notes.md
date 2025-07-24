## Adding a New Supplier Driver (Heavenly)

This document outlines the steps to add a new supplier driver named `Heavenly` into the system.

---

### 1. Add Configuration for the New Supplier

Open the `config/supplier.php` file and add a new configuration array for `heavenly`:

```php
<?php

return [
    'heavenly' => [
        'base_url' => env('HEAVENLY_BASE_URL', 'https://mock.turpal.com'),
        'username' => env('HEAVENLY_USERNAME', null),
        'password' => env('HEAVENLY_PASSWORD', null),
    ],
    // Add other suppliers config below
];
```

---

### 2. Define a New Driver in `SupplierManager`

Inside the `SupplierManager` class, create a new method to define the `heavenly` driver:

```php
public function createHeavenlyDriver(array $config): ISupplierAdaptor
{
    $supplier = app(Heavenly::class, [
        'config' => $config,
    ]);

    return app(HeavenlyAdaptor::class, [
        'supplier' => $supplier,
    ]);
}
```

This method initializes the `Heavenly` supplier class and wraps it with a `HeavenlyAdaptor` to conform to the `ISupplierAdaptor` interface.

---

### 3. Create Base Classes for the Supplier

You must create the following classes:

* `Heavenly`: A class responsible for communicating with the supplier's API (usually HTTP-based).
* `HeavenlyAdaptor`: A class that implements the `ISupplierAdaptor` interface and adapts the supplier's data into your system's expected format.

Both classes should follow the established pattern used in other supplier integrations.

---

### Summary

* ✅ Added new configuration in `config/supplier.php`
* ✅ Defined `createHeavenlyDriver` in `SupplierManager`
* ⏳ Implement `Heavenly` and `HeavenlyAdaptor` classes

This setup ensures the new supplier can be easily instantiated via Laravel's service container and used uniformly across the application.

### Testing Coverage
Currently, only the `Heavenly` and `HeavenlyAdaptor` classes have automated tests implemented. Other components and integrations do not have test coverage yet.
