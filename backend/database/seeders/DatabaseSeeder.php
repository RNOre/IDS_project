<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AverageBall;
use App\Models\EducInst;
use App\Models\Event;
use App\Models\IndivAchivBall;
use App\Models\Level;
use App\Models\PartificationFact;
use App\Models\Scale;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\StudentGroupRegistration;
use App\Models\TypeIndivAchiv;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $students = array(
            array('value' => '111111'),
            array('value' => '111222'),
            array('value' => '111333'),
            array('value' => '111444'),
            array('value' => '111555'),
            array('value' => '111666'),
        );

        $average_ball = array(
            array('date' => '2023.11.20', 'value' => 4.0, 'student_id'=>1),
            array('date' => '2023.11.20', 'value' => 4.8, 'student_id'=>2),
            array('date' => '2023.11.20', 'value' => 4.0, 'student_id'=>3),
            array('date' => '2023.11.20', 'value' => 5.0, 'student_id'=>4),
            array('date' => '2023.11.20', 'value' => 4.1, 'student_id'=>5),
            array('date' => '2023.11.20', 'value' => 5.0, 'student_id'=>6),
        );

        $type_indiv_achiv = array(
            array('name' => 'УД'),
            array('name' => 'ОД'),
            array('name' => 'НИД'));

        $educ_inst = array(
            array('name' => 'ОГУ', 'shortName' => 'ОГУ', 'unitName' => 'ОГУ'));

        $student_group = array(
            array('name' => '20ПИнж', 'educ_inst_id' => 1),
            array('name' => '20ИВТ', 'educ_inst_id' => 1));

        $student_group_registration = array(
            array('enrollmentDate' => '01.09.2020', 'student_id' => 1, 'student_group_id' => 1),
            array('enrollmentDate' => '01.09.2020', 'student_id' => 2, 'student_group_id' => 1),
            array('enrollmentDate' => '01.09.2020', 'student_id' => 3, 'student_group_id' => 1),
            array('enrollmentDate' => '01.09.2020', 'student_id' => 4, 'student_group_id' => 2),
            array('enrollmentDate' => '01.09.2020', 'student_id' => 5, 'student_group_id' => 2),
            array('enrollmentDate' => '01.09.2020', 'student_id' => 6, 'student_group_id' => 2),
        );

        $levels = array(
            array('name' => 'Факультетский', 'shortName' => 'Фак.'),
            array('name' => 'Ведомственный', 'shortName' => 'Вед.'),
            array('name' => 'Региональный', 'shortName' => 'Рег.'),
            array('name' => 'Всероссийский', 'shortName' => 'Всеросс.'),
            array('name' => 'Международный', 'shortName' => 'Межд.'));

        $scales = array(
            array('value' => 1),
            array('value' => 2),
            array('value' => 3),
            array('value' => 4),
            array('value' => 5),
            array('value' => 6),
            array('value' => 8),
            array('value' => 9),
            array('value' => 10),
            array('value' => 12),
            array('value' => 15),
        );

        $events = array(
            array('name' => 'Олимпиада', 'educ_inst_id' => 1, 'level_id' => 4),
            array('name' => 'Проектная_деятельность', 'educ_inst_id' => 1, 'level_id' => 4),
            array('name' => 'Конференция', 'educ_inst_id' => 1, 'level_id' => 5),
            array('name' => 'Конференция', 'educ_inst_id' => 1, 'level_id' => 3),
            array('name' => 'Организация', 'educ_inst_id' => 1, 'level_id' => 1),
            array('name' => 'Организация', 'educ_inst_id' => 1, 'level_id' => 2),
            array('name' => 'Организация', 'educ_inst_id' => 1, 'level_id' => 3),
            array('name' => 'Награды', 'educ_inst_id' => 1, 'level_id' => 4),
            array('name' => 'Награды', 'educ_inst_id' => 1, 'level_id' => 3),
            array('name' => 'Инф_обесп', 'educ_inst_id' => 1, 'level_id' => 1),
            array('name' => 'Инф_обесп', 'educ_inst_id' => 1, 'level_id' => 2),
            array('name' => 'Грант', 'educ_inst_id' => 1, 'level_id' => 5),
            array('name' => 'Патент', 'educ_inst_id' => 1, 'level_id' => 5),
        );

        $indiv_achiv_ball = array(
            array('date' => '01.01.2023', 'student_id' => 1, 'type_indiv_achiv_id' => 1),
            array('date' => '01.01.2023', 'student_id' => 1, 'type_indiv_achiv_id' => 2),
        );

        $part_fact = array(
            array('date' => '01.01.2023', 'category' => 'Участник', 'event_id' => 1, 'student_id' => 1),
            array('date' => '01.01.2023', 'category' => 'Победитель', 'event_id' => 2, 'student_id' => 1),
        );

        $indvi_achiv_ball_scale = array(
            array('indiv_achiv_ball_id' => 1, 'scale_id' => 4),
            array('indiv_achiv_ball_id' => 2, 'scale_id' => 10),
        );

        DB::table(('students'))->insert($students);
        DB::table(('average_balls'))->insert($average_ball);
        DB::table(('type_indiv_achivs'))->insert($type_indiv_achiv);
        DB::table(('indiv_achiv_balls'))->insert($indiv_achiv_ball);
        DB::table(('educ_insts'))->insert($educ_inst);
        DB::table(('student_groups'))->insert($student_group);
        DB::table(('student_group_registrations'))->insert($student_group_registration);
        DB::table(('levels'))->insert($levels);
        DB::table(('scales'))->insert($scales);
//        DB::table(('indiv_achiv_ball_scales'))->insert($indvi_achiv_ball_scale);
        DB::table(('events'))->insert($events);
        DB::table(('partification_facts'))->insert($part_fact);

//        Student::factory(10)->create();
//        AverageBall::factory(40)->create();
//        TypeIndivAchiv::factory(3)->create();
//        IndivAchivBall::factory(40)->create();
//        EducInst::factory(1)->create();
//        StudentGroup::factory(5)->create();
//        StudentGroupRegistration::factory(10)->create();
//        Level::factory(5)->create();//adjl
//        DB::table(('levels'))->insert($levels);
//        Scale::factory(5)->create();//djs
//        Event::factory(5)->create();
//        PartificationFact::factory(5)->create();
    }
}
