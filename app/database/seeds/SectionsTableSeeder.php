<?php

class SectionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sections')->delete();

        DB::table('sections')->insert( 
            array(
                array('section' => 'News'),
                array('section' => 'Opinion'),
                array('section' => 'Magazine'),
                array('section' => 'Sports'),
                array('section' => 'Arts'),
                array('section' => 'Media'),
                array('section' => 'Flyby')
            )
        );
    }

}
