<?php

use Illuminate\Database\Seeder;
use App\PageType;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pt = new PageType();
        $pt->name = "public";
        $pt->save();

        $pt = new PageType();
        $pt->name = "donor";
        $pt->save();

        $pt = new PageType();
        $pt->name = "admin";
        $pt->save();
    }
}
