<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExperiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert([
            [
                'user_id' => 1,
                'exp_date' => '2023-2024',
                'workplace' => '<strong>CEGOC</strong>',
                'position' => 'Junior Full Stack Developer', 
                'description' => "<p>Responsible for implementing four new features on the CEGOC Digital Studio Portal:</p>
<ul>
<li> <u>New Releases Feature</u> ( Feature that shows a modal window with announcements not seen by the current user; if it has been seen, the modal will not appear )</li>
<li> <u>Notice Page</u> ( I created a specific page without restrictions inside the CEGOC Portal in order to show, in a visually appealing way, the content of the courses/modules. Depending on whether there are media details in the Database, the page shows images or videos according to the current module/course )</li>
<li> <u>Configurator</u> ( I created a feature that helps the CEGOC Portal user to find the available content based on the selected competences/skills. The content is shown in a dynamic HTML table, with specific ordering.
The interface itself is based on HTML select boxes values passed through the HTML form )</li>
<li> <u>Print Catalogue</u> ( I created a tool that allows the CEGOC Portal user to create a commercial catalogue with CEGOC Digital Assets, to send to their clients. The interface consists on multiple HTML select boxes and checkboxes that define if specific columns appear or not on the preview. After selecting the respective values, it will create dynamic HTML tables divided by categories , then the View PDF button becomes available and the user can view the PDF and print or download the current PDF )</li>
</ul>"
            ],
            [
                'user_id' => 1,
                'exp_date' => '2017',
                'workplace' => '<strong>Centro de Oceanografia da Faculdade de Ciências de Lisboa</strong>',
                'position' => 'Website Content Manager', 
                'description' => 'Responsible for mainly adding content in the Database and doing some HTML and CSS tweaks through the Content Management System <strong>Drupal</strong>.'
            ],
            [
                'user_id' => 1,
                'exp_date' => '2002-2010',
                'workplace' => '<strong>Portuguese Army</strong>',
                'position' => 'IT Help Desk', 
                'description' => 'Worked as an IT Technician in the Portuguese Army.
                My main functions were:
                <ul><li>Hardware Repair and Maintenance</li>
                <li>Network Management</li>
                <li>Software Installation, Configuration and Maintenance</li></ul>'                
            ]
        ]);
    }
}
