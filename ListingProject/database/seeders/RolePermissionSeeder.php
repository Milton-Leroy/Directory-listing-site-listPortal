<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array(
            array('id' => '1', 'name' => 'section index', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2024-08-21 10:19:45', 'updated_at' => '2024-08-21 10:19:45'),
            array('id' => '2', 'name' => 'section create', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2024-08-21 10:20:01', 'updated_at' => '2024-08-21 10:20:01'),
            array('id' => '3', 'name' => 'section update', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2024-08-21 10:20:10', 'updated_at' => '2024-08-21 10:20:10'),
            array('id' => '4', 'name' => 'section delete', 'group_name' => 'section', 'guard_name' => 'web', 'created_at' => '2024-08-21 10:20:19', 'updated_at' => '2024-08-21 10:20:19'),
            array('id' => '5', 'name' => 'listing index', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:01:08', 'updated_at' => '2024-08-21 11:01:08'),
            array('id' => '6', 'name' => 'listing update', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:01:20', 'updated_at' => '2024-08-21 11:01:20'),
            array('id' => '7', 'name' => 'listing create', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:01:39', 'updated_at' => '2024-08-21 11:01:39'),
            array('id' => '8', 'name' => 'listing delete', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:02:31', 'updated_at' => '2024-08-21 11:02:31'),
            array('id' => '9', 'name' => 'pending listing', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:03:14', 'updated_at' => '2024-08-21 11:03:14'),
            array('id' => '10', 'name' => 'listing review', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:03:29', 'updated_at' => '2024-08-21 11:03:29'),
            array('id' => '11', 'name' => 'listing claims', 'group_name' => 'listing', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:05:23', 'updated_at' => '2024-08-21 11:05:23'),
            array('id' => '12', 'name' => 'package index', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:10:46', 'updated_at' => '2024-08-21 11:10:46'),
            array('id' => '13', 'name' => 'package create', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:10:55', 'updated_at' => '2024-08-21 11:10:55'),
            array('id' => '14', 'name' => 'package update', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:11:02', 'updated_at' => '2024-08-21 11:11:02'),
            array('id' => '15', 'name' => 'package delete', 'group_name' => 'package', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:11:16', 'updated_at' => '2024-08-21 11:11:16'),
            array('id' => '16', 'name' => 'order index', 'group_name' => 'order', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:12:56', 'updated_at' => '2024-08-21 11:12:56'),
            array('id' => '17', 'name' => 'order delete', 'group_name' => 'order', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:13:04', 'updated_at' => '2024-08-21 11:13:04'),
            array('id' => '18', 'name' => 'message index', 'group_name' => 'message', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:14:34', 'updated_at' => '2024-08-21 11:14:34'),
            array('id' => '19', 'name' => 'testimonial index', 'group_name' => 'testimonial', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:14:58', 'updated_at' => '2024-08-21 11:14:58'),
            array('id' => '20', 'name' => 'testimonial create', 'group_name' => 'testimonial', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:15:04', 'updated_at' => '2024-08-21 11:15:04'),
            array('id' => '21', 'name' => 'testimonial update', 'group_name' => 'testimonial', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:15:13', 'updated_at' => '2024-08-21 11:15:13'),
            array('id' => '22', 'name' => 'testimonial delete', 'group_name' => 'testimonial', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:15:22', 'updated_at' => '2024-08-21 11:15:22'),
            array('id' => '23', 'name' => 'blog index', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:18:42', 'updated_at' => '2024-08-21 11:18:42'),
            array('id' => '24', 'name' => 'blog create', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:18:50', 'updated_at' => '2024-08-21 11:18:50'),
            array('id' => '25', 'name' => 'blog update', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:18:56', 'updated_at' => '2024-08-21 11:18:56'),
            array('id' => '26', 'name' => 'blog delete', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:19:03', 'updated_at' => '2024-08-21 11:19:03'),
            array('id' => '27', 'name' => 'blog comment', 'group_name' => 'blog', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:19:11', 'updated_at' => '2024-08-21 11:19:11'),
            array('id' => '28', 'name' => 'about index', 'group_name' => 'pages', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:21:34', 'updated_at' => '2024-08-21 11:21:34'),
            array('id' => '29', 'name' => 'contact index', 'group_name' => 'pages', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:21:49', 'updated_at' => '2024-08-21 11:21:49'),
            array('id' => '30', 'name' => 'privacy policy index', 'group_name' => 'pages', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:22:06', 'updated_at' => '2024-08-21 11:22:06'),
            array('id' => '31', 'name' => 'terms and conditions index', 'group_name' => 'pages', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:22:32', 'updated_at' => '2024-08-21 11:22:32'),
            array('id' => '32', 'name' => 'footer index', 'group_name' => 'footer', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:24:08', 'updated_at' => '2024-08-21 11:24:08'),
            array('id' => '33', 'name' => 'social link index', 'group_name' => 'footer', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:24:19', 'updated_at' => '2024-08-21 11:24:19'),
            array('id' => '34', 'name' => 'access management index', 'group_name' => 'access mangement', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:28:05', 'updated_at' => '2024-08-21 11:28:05'),
            array('id' => '35', 'name' => 'menu builder index', 'group_name' => 'menu builder', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:29:05', 'updated_at' => '2024-08-21 11:29:05'),
            array('id' => '36', 'name' => 'setting index', 'group_name' => 'settings', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:29:58', 'updated_at' => '2024-08-21 11:29:58'),
            array('id' => '37', 'name' => 'payment setting index', 'group_name' => 'settings', 'guard_name' => 'web', 'created_at' => '2024-08-21 11:30:08', 'updated_at' => '2024-08-21 11:30:08')
        );

        $roles = array(
            array('id' => '2', 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => '2024-08-21 12:53:34', 'updated_at' => '2024-08-21 12:53:34'),
            array('id' => '3', 'name' => 'Writer', 'guard_name' => 'web', 'created_at' => '2024-08-21 13:21:51', 'updated_at' => '2024-08-21 13:21:51')
        );

        $role_has_permissions = array(
            array('permission_id' => '23', 'role_id' => '3'),
            array('permission_id' => '24', 'role_id' => '3'),
            array('permission_id' => '25', 'role_id' => '3'),
            array('permission_id' => '26', 'role_id' => '3'),
            array('permission_id' => '27', 'role_id' => '3')
        );

        $model_has_roles = array(
            array('role_id' => '2', 'model_type' => 'App\\Models\\User', 'model_id' => '1'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '5'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '6'),
            array('role_id' => '3', 'model_type' => 'App\\Models\\User', 'model_id' => '7')
        );

        \DB::table('permissions')->insert($permissions);
        \DB::table('roles')->insert($roles);
        \DB::table('role_has_permissions')->insert($role_has_permissions);
        \DB::table('model_has_roles')->insert($model_has_roles);
    }
}
