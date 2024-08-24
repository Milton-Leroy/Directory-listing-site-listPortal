<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section_titles = array(
            array('id' => '1','our_feature_title' => 'Our Features','our_feature_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_categories_title' => 'Our Categories','our_categories_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_location_title' => 'Our location','our_location_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_featured_listing_title' => 'Our Featured Listing','our_featured_listing_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_our_pricing_title' => 'Our pricing','our_our_pricing_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_testimonial_title' => 'Testimonials','our_testimonial_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','our_blog_title' => 'Our blogs','our_blog_sub_title' => 'Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut clita dolorem ei est mazim fuisset scribentur.','created_at' => '2024-08-23 20:49:29','updated_at' => '2024-08-23 21:23:06')
          );

        \DB::table('section_titles')->insert($section_titles);
    }
}
