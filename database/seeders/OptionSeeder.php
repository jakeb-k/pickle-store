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
        DB::table('options')->insert(['type'=>'Cover','values'=>'On.Off','prod_id'=>1]);
        DB::table('options')->insert(['type'=>'Color','values'=>'A.B','prod_id'=>2]);
        DB::table('options')->insert(['type'=>'color','values'=>'B.Y.R','prod_id'=>3]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','prod_id'=>4]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','prod_id'=>6]);
        DB::table('options')->insert(['type'=>'cover','values'=>'On.Off','prod_id'=>7]);
        DB::table('options')->insert(['type'=>'color','values'=>'O.B.G.R','prod_id'=>10]);
        DB::table('options')->insert(['type'=>'color','values'=>'A.B','prod_id'=>12]);
        DB::table('options')->insert(['type'=>'color','values'=>'O.W','prod_id'=>13]);
        DB::table('options')->insert(['type'=>'size','values'=>'S.M.L','prod_id'=>23]);
        DB::table('options')->insert(['type'=>'color','values'=>'lBl.G.Y','prod_id'=>20]);
        DB::table('options')->insert(['type'=>'color','values'=>'G.Y','prod_id'=>21]);
        DB::table('options')->insert(['type'=>'hand ','values'=>'Finger.less','prod_id'=>22]);
        DB::table('options')->insert(['type'=>'hand ','values'=>'L.R','prod_id'=>23]);
        DB::table('options')->insert(['type'=>'size','values'=>'XS.S.M.L.XL','prod_id'=>24]);
        DB::table('options')->insert(['type'=>'color ','values'=>'R.G.B','prod_id'=>25]);
        DB::table('options')->insert(['type'=>'color ','values'=>'Y.G.B','prod_id'=>26]);
        DB::table('options')->insert(['type'=>'color ','values'=>'G.W.Y','prod_id'=>27]);
        DB::table('options')->insert(['type'=>'color ','values'=>'Bl.R.B','prod_id'=>28]);
        DB::table('options')->insert(['type'=>'color ','values'=>'W.O.Bl','prod_id'=>29]);
        DB::table('options')->insert(['type'=>'color ','values'=>'G.O.B','prod_id'=>30]);
        DB::table('options')->insert(['type'=>'color ','values'=>'B.dGr.G','prod_id'=>31]);
        DB::table('options')->insert(['type'=>'color ','values'=>'B.lBl.O','prod_id'=>32]);
        DB::table('options')->insert(['type'=>'color ','values'=>'Gr.R.W','prod_id'=>33]);
        DB::table('options')->insert(['type'=>'color ','values'=>'Gr.R.W','prod_id'=>34]);
        DB::table('options')->insert(['type'=>'color ','values'=>'dBl.Gr.B','prod_id'=>35]);
    }
}
