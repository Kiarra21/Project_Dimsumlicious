<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to all features',
                'permissions' => [
                    // Product Management
                    'product.view',
                    'product.create',
                    'product.edit',
                    'product.delete',
                    'product.manage_status',
                    'product.upload_photo',
                    
                    // Category Management
                    'category.view',
                    'category.create',
                    'category.edit',
                    'category.delete',
                    
                    // Staff Management
                    'staff.view',
                    'staff.create',
                    'staff.edit',
                    'staff.delete',
                    
                    // Reports & Finance
                    'report.view',
                    'report.sales',
                    'report.finance',
                    'report.download',
                    'report.transactions',
                    'report.profit',
                    'report.charts',
                    
                    // Promo Management
                    'promo.view',
                    'promo.create',
                    'promo.edit',
                    'promo.delete',
                    'promo.upload_banner',
                    'promo.manage_status',
                    
                    // Company Profile
                    'company.view',
                    'company.edit',
                    'company.edit_description',
                    'company.edit_location',
                    'company.edit_contact',
                    'company.upload_media',
                ]
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Limited access for staff members',
                'permissions' => [
                    // Product Management (Limited)
                    'product.view',
                    'product.create',
                    'product.edit',
                    'product.delete',
                    'product.manage_status',
                    'product.upload_photo',
                    
                    // Promo Management
                    'promo.view',
                    'promo.create',
                    'promo.edit',
                    'promo.upload_banner',
                    
                    // Sales Monitoring (No finance access)
                    'report.view',
                    'report.transactions',
                ]
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'Regular user with basic access',
                'permissions' => [
                    // View only
                    'product.view',
                    'promo.view',
                    'company.view',
                    
                    // Shopping (future feature)
                    'cart.add',
                    'cart.view',
                    'order.create',
                    'order.view',
                ]
            ]
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}
