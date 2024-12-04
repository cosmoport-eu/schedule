<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Facilities;
use App\Models\Gates;
use App\Models\Materials;
use App\Models\Settings;
use App\Models\Statuses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        
        foreach ([
            ['i18n_name_code' => 'category_1', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'category_2', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'category_3', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Categories::create($item);
        }

        foreach ([
            ['i18n_name_code' => 'status_1', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'status_2', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'status_3', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'status_4', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'status_5', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'status_6', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Statuses::create($item);
        }

        foreach ([
            ['i18n_name_code' => 'gate_1', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'gate_2', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'gate_3', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Gates::create($item);
        }

        foreach ([
            ['i18n_name_code' => 'facility_1', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'facility_2', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'facility_3', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'facility_4', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'facility_5', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'facility_6', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Facilities::create($item);
        }

        foreach ([
            ['i18n_name_code' => 'material_1', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'material_2', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'material_3', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'material_4', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'material_5', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Materials::create($item);
        }

        foreach ([
            ['parameter' => 'timetable_screen_lines', 'value' => '20', 'created_at' => $date, 'updated_at' => $date],
            ['parameter' => 'pause', 'value' => '5', 'created_at' => $date, 'updated_at' => $date],
            ['parameter' => 'working_hours', 'value' => '{"hours":[{"day":"mon","start":0,"end":0,"non":false},{"day":"tue","start":0,"end":0,"non":false},{"day":"wed","start":0,"end":0,"non":false},{"day":"thu","start":0,"end":0,"non":false},{"day":"fri","start":0,"end":0,"non":false},{"day":"sat","start":0,"end":0,"non":true},{"day":"sun","start":0,"end":0,"non":true}]}', 'created_at' => $date, 'updated_at' => $date]
        ] as $item) {
            Settings::create($item);
        }
    }
}
