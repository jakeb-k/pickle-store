<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('options')->insert(['type'=>'Cover','values'=>'On.Off','product_id'=>1]);
        DB::table('options')->insert(['type'=>'Color','values'=>'A.B','product_id'=>2]);
        DB::table('options')->insert(['type'=>'color','values'=>'B.Y.R','product_id'=>3]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','product_id'=>4]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','product_id'=>6]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','product_id'=>7]);
        DB::table('options')->insert(['type'=>'color','values'=>'O.B.G.R','product_id'=>10]);
        DB::table('options')->insert(['type'=>'color','values'=>'A.B','product_id'=>12]);
        DB::table('options')->insert(['type'=>'color','values'=>'O.W','product_id'=>13]);
        DB::table('options')->insert(['type'=>'size','values'=>'S.M.L','product_id'=>23]);
        DB::table('options')->insert(['type'=>'color','values'=>'lightblue.green.yellow','product_id'=>20]);
        DB::table('options')->insert(['type'=>'color','values'=>'green.yellow','product_id'=>21]);
        DB::table('options')->insert(['type'=>'hand ','values'=>'Finger.less','product_id'=>22]);
        DB::table('options')->insert(['type'=>'hand ','values'=>'L.R','product_id'=>23]);
        DB::table('options')->insert(['type'=>'size','values'=>'XS.S.M.L.XL','product_id'=>24]);
        DB::table('options')->insert(['type'=>'color ','values'=>'red.green.black','product_id'=>25]);
        DB::table('options')->insert(['type'=>'color ','values'=>'yellow.green.black','product_id'=>26]);
        DB::table('options')->insert(['type'=>'color ','values'=>'green.white.yellow','product_id'=>27]);
        DB::table('options')->insert(['type'=>'color ','values'=>'blue.red.black','product_id'=>28]);
        DB::table('options')->insert(['type'=>'color ','values'=>'white.orange.blue','product_id'=>29]);
        DB::table('options')->insert(['type'=>'color ','values'=>'green.orange.black','product_id'=>30]);
        DB::table('options')->insert(['type'=>'color ','values'=>'black.darkgray.green','product_id'=>31]);
        DB::table('options')->insert(['type'=>'color ','values'=>'black.lightblue.orange','product_id'=>32]);
        DB::table('options')->insert(['type'=>'color ','values'=>'gray.red.white','product_id'=>33]);
        DB::table('options')->insert(['type'=>'color ','values'=>'gray.red.white','product_id'=>34]);
        DB::table('options')->insert(['type'=>'color ','values'=>'darkblue.green.black','product_id'=>35]);

    }
}
