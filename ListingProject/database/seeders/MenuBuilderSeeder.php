<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array('id' => '3', 'name' => 'Main Menu', 'created_at' => '2024-08-20 13:00:59', 'updated_at' => '2024-08-20 13:32:07'),
            array('id' => '6', 'name' => 'Footer Menu  One', 'created_at' => '2024-08-20 18:30:42', 'updated_at' => '2024-08-20 18:30:42'),
            array('id' => '7', 'name' => 'Footer Menu Two', 'created_at' => '2024-08-20 18:31:36', 'updated_at' => '2024-08-20 18:31:36'),
            array('id' => '9', 'name' => 'Footer Menu Three', 'created_at' => '2024-08-20 18:32:04', 'updated_at' => '2024-08-20 18:32:04')
        );

        $admin_menu_items = array(
            array('id' => '1', 'label' => 'Home', 'link' => '/', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:02:13', 'updated_at' => '2024-08-20 13:04:12'),
            array('id' => '2', 'label' => 'About Us', 'link' => '/about-us', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:03:57', 'updated_at' => '2024-08-20 13:05:08'),
            array('id' => '3', 'label' => 'Blogs', 'link' => '/blog', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:05:08', 'updated_at' => '2024-08-20 13:05:08'),
            array('id' => '4', 'label' => 'Listings', 'link' => '/listings', 'parent_id' => '0', 'sort' => '3', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:07:46', 'updated_at' => '2024-08-20 13:07:46'),
            array('id' => '5', 'label' => 'Contact Us', 'link' => '/contact', 'parent_id' => '0', 'sort' => '4', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:12:39', 'updated_at' => '2024-08-20 13:12:39'),
            array('id' => '6', 'label' => 'Privacy Policy', 'link' => '/privacy-policy', 'parent_id' => '8', 'sort' => '6', 'class' => NULL, 'menu_id' => '3', 'depth' => '1', 'created_at' => '2024-08-20 13:13:24', 'updated_at' => '2024-08-20 13:43:32'),
            array('id' => '7', 'label' => 'Terms and Conditions', 'link' => '/terms-and-conditions', 'parent_id' => '8', 'sort' => '7', 'class' => NULL, 'menu_id' => '3', 'depth' => '1', 'created_at' => '2024-08-20 13:14:34', 'updated_at' => '2024-08-20 13:43:32'),
            array('id' => '8', 'label' => 'Pages', 'link' => '#', 'parent_id' => '0', 'sort' => '5', 'class' => NULL, 'menu_id' => '3', 'depth' => '0', 'created_at' => '2024-08-20 13:42:22', 'updated_at' => '2024-08-20 13:42:42'),
            array('id' => '9', 'label' => 'Login', 'link' => '/login', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '6', 'depth' => '0', 'created_at' => '2024-08-20 18:32:49', 'updated_at' => '2024-08-20 18:33:08'),
            array('id' => '10', 'label' => 'Register', 'link' => '/register', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '6', 'depth' => '0', 'created_at' => '2024-08-20 18:33:07', 'updated_at' => '2024-08-20 18:34:39'),
            array('id' => '11', 'label' => 'Forget Password', 'link' => '/forgot-password', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '6', 'depth' => '0', 'created_at' => '2024-08-20 18:34:39', 'updated_at' => '2024-08-20 18:38:08'),
            array('id' => '14', 'label' => 'Contact Us', 'link' => '/contact', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '7', 'depth' => '0', 'created_at' => '2024-08-20 20:28:52', 'updated_at' => '2024-08-20 20:29:10'),
            array('id' => '15', 'label' => 'Terms and Conditions', 'link' => '/terms-and-conditions', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '7', 'depth' => '0', 'created_at' => '2024-08-20 20:29:09', 'updated_at' => '2024-08-20 20:29:22'),
            array('id' => '16', 'label' => 'Privacy Policy', 'link' => '/privacy-policy', 'parent_id' => '0', 'sort' => '3', 'class' => NULL, 'menu_id' => '7', 'depth' => '0', 'created_at' => '2024-08-20 20:29:21', 'updated_at' => '2024-08-20 20:29:21'),
            array('id' => '17', 'label' => 'Blogs', 'link' => '/blog', 'parent_id' => '0', 'sort' => '2', 'class' => NULL, 'menu_id' => '9', 'depth' => '0', 'created_at' => '2024-08-20 20:30:26', 'updated_at' => '2024-08-20 20:31:09'),
            array('id' => '18', 'label' => 'Listings', 'link' => '/listings', 'parent_id' => '0', 'sort' => '1', 'class' => NULL, 'menu_id' => '9', 'depth' => '0', 'created_at' => '2024-08-20 20:30:38', 'updated_at' => '2024-08-20 20:31:09'),
            array('id' => '19', 'label' => 'Home', 'link' => '/', 'parent_id' => '0', 'sort' => '0', 'class' => NULL, 'menu_id' => '9', 'depth' => '0', 'created_at' => '2024-08-20 20:30:59', 'updated_at' => '2024-08-20 20:31:06')
        );

        \DB::table('admin_menus')->insert($admin_menus);
        \DB::table('admin_menu_items')->insert($admin_menu_items);
    }
}
