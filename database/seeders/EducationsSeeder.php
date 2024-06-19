<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educations')->insert([
            ['user_id' => 1,'edu_date'=> '2022', 'location' => '<em>Academia de Código</em> - <i>FullStack Development Bootcamp</i>'],
            ['user_id' => 1,'edu_date'=> '2020', 'location' => '<em>CINEL</em> - <i>Criação de Websites</i>'],
            ['user_id' => 1,'edu_date'=> '2019', 'location' => '<em>CINEL</em> - <i>Introdução a Java</i>'],
            ['user_id' => 1,'edu_date'=> '2018', 'location' => '<em>CINEL</em> - <i>Programação Web - LAMP</i>'],
            ['user_id' => 1,'edu_date'=> '2015', 'location' => '<em>Centro de Formação FLAG</em> - <i>Web Programmer</i>'],
            ['user_id' => 1,'edu_date'=> '1998-2002', 'location' => '<em>INETE</em> - <i>Técnico de Gestão de Sistemas Informáticos</i>']                         
        ]);
    }
}
