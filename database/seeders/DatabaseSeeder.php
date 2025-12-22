<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Ingredient;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $adminRole = Role::create([
            'name' => 'Admin',
        ]);

        $managerRole = Role::create([
            'name' => 'Manager',
        ]);

        $staffRole = Role::create([
            'name' => 'Staff',
        ]);

        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sweetcrust.com',
            'password' => Hash::make('admin123'),
            'roleId' => $adminRole->id,
            'verified' => true,
        ]);

        // Create Manager User
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@sweetcrust.com',
            'password' => Hash::make('manager123'),
            'roleId' => $managerRole->id,
            'verified' => true,
        ]);

        // Create Staff User
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@sweetcrust.com',
            'password' => Hash::make('staff123'),
            'roleId' => $staffRole->id,
            'verified' => true,
        ]);

        // Create Test Customer
        Customer::create([
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'phone' => '+92-300-9999999',
            'address' => '123 Test Street, Karachi, 75500',
            'verified' => true,
        ]);

        // Create Ingredients
        Ingredient::create([
            'name' => 'All-Purpose Flour',
            'quantity' => 50.00,
            'unit' => 'kg',
            'lowStockThreshold' => 10.00,
        ]);

        Ingredient::create([
            'name' => 'White Sugar',
            'quantity' => 30.00,
            'unit' => 'kg',
            'lowStockThreshold' => 5.00,
        ]);

        Ingredient::create([
            'name' => 'Butter',
            'quantity' => 20.00,
            'unit' => 'kg',
            'lowStockThreshold' => 5.00,
        ]);

        Ingredient::create([
            'name' => 'Eggs',
            'quantity' => 100.00,
            'unit' => 'pieces',
            'lowStockThreshold' => 20.00,
        ]);

        Ingredient::create([
            'name' => 'Dark Chocolate',
            'quantity' => 15.00,
            'unit' => 'kg',
            'lowStockThreshold' => 3.00,
        ]);

        Ingredient::create([
            'name' => 'Vanilla Extract',
            'quantity' => 2.00,
            'unit' => 'liters',
            'lowStockThreshold' => 0.5,
        ]);

        Ingredient::create([
            'name' => 'Heavy Cream',
            'quantity' => 10.00,
            'unit' => 'liters',
            'lowStockThreshold' => 2.00,
        ]);

        Ingredient::create([
            'name' => 'Cocoa Powder',
            'quantity' => 8.00,
            'unit' => 'kg',
            'lowStockThreshold' => 2.00,
        ]);

        // Create Products
        Product::create([
            'productName' => 'Chocolate Cake',
            'description' => 'Rich and moist chocolate cake with chocolate frosting',
            'category' => 'Cakes',
            'price' => 2500.00,
            'stockQuantity' => 10,
            'imageUrl' => 'images/products/chocolate-cake.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Vanilla Cupcakes',
            'description' => 'Soft vanilla cupcakes with buttercream frosting (6 pieces)',
            'category' => 'Cupcakes',
            'price' => 800.00,
            'stockQuantity' => 20,
            'imageUrl' => 'images/products/cupcakes.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Chocolate Chip Cookies',
            'description' => 'Classic chocolate chip cookies (12 pieces)',
            'category' => 'Cookies',
            'price' => 600.00,
            'stockQuantity' => 30,
            'imageUrl' => 'images/products/cookies.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Red Velvet Cake',
            'description' => 'Classic red velvet cake with cream cheese frosting',
            'category' => 'Cakes',
            'price' => 3000.00,
            'stockQuantity' => 8,
            'imageUrl' => 'images/products/red-velvet-cake.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Blueberry Muffins',
            'description' => 'Fresh blueberry muffins (6 pieces)',
            'category' => 'Muffins',
            'price' => 700.00,
            'stockQuantity' => 15,
            'imageUrl' => 'images/products/muffins.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Brownies',
            'description' => 'Fudgy chocolate brownies (9 pieces)',
            'category' => 'Brownies',
            'price' => 900.00,
            'stockQuantity' => 12,
            'imageUrl' => 'images/products/brownies.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Strawberry Shortcake',
            'description' => 'Light sponge cake with fresh strawberries and whipped cream',
            'category' => 'Cakes',
            'price' => 2800.00,
            'stockQuantity' => 6,
            'imageUrl' => 'images/products/strawberry-cake.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Cinnamon Rolls',
            'description' => 'Soft cinnamon rolls with cream cheese glaze (6 pieces)',
            'category' => 'Pastries',
            'price' => 850.00,
            'stockQuantity' => 18,
            'imageUrl' => 'images/products/croissant.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Lemon Tart',
            'description' => 'Tangy lemon tart with buttery crust',
            'category' => 'Tarts',
            'price' => 1500.00,
            'stockQuantity' => 10,
            'imageUrl' => 'images/products/lemon-tart.jpg',
            'isActive' => true,
        ]);

        Product::create([
            'productName' => 'Croissants',
            'description' => 'Buttery, flaky croissants (4 pieces)',
            'category' => 'Pastries',
            'price' => 650.00,
            'stockQuantity' => 25,
            'imageUrl' => 'images/products/croissant.jpg',
            'isActive' => true,
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('');
        $this->command->info('STAFF ADMIN:');
        $this->command->info('Email: admin@sweetcrust.com');
        $this->command->info('Password: admin123');
        $this->command->info('');
        $this->command->info('STAFF MANAGER:');
        $this->command->info('Email: manager@sweetcrust.com');
        $this->command->info('Password: manager123');
        $this->command->info('');
        $this->command->info('STAFF USER:');
        $this->command->info('Email: staff@sweetcrust.com');
        $this->command->info('Password: staff123');
        $this->command->info('');
        $this->command->info('TEST CUSTOMER:');
        $this->command->info('Email: customer@test.com');
        $this->command->info('Password: customer123');
        $this->command->info('');
    }
}
