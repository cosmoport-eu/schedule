<?php

namespace Database\Seeders;

use App\Models\InterfaceElements;
use App\Models\Translations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InterfaceElementsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $uiElements = [
            ['i18n_name_code' => 'ui_caption_category', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_type', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_subtype', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_name', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_description', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_duration', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_departing', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_arrival', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_status', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_limit', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_time_to_departure', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_time_to_arrival', 'created_at' => $date, 'updated_at' => $date],
            ['i18n_name_code' => 'ui_caption_next_events', 'created_at' => $date, 'updated_at' => $date]
        ];

        $translations = [
            ['locale_id' => 1, 'code' => 'ui_caption_category', 'text' => 'Category', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_category', 'text' => '(RU) Category', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_category', 'text' => '(GR) Category', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_type', 'text' => 'Type', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_type', 'text' => '(RU) Type', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_type', 'text' => '(GR) Type', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_subtype', 'text' => 'Subtype', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_subtype', 'text' => '(RU) Subtype', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_subtype', 'text' => '(GR) Subtype', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_name', 'text' => 'Name', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_name', 'text' => '(RU) Name', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_name', 'text' => '(GR) Name', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_description', 'text' => 'Description', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_description', 'text' => '(RU) Description', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_description', 'text' => '(GR) Description', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_duration', 'text' => 'Duration', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_duration', 'text' => '(RU) Duration', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_duration', 'text' => '(GR) Duration', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_departing', 'text' => 'Departing', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_departing', 'text' => '(RU) Departing', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_departing', 'text' => '(GR) Departing', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_arrival', 'text' => 'Arrival', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_arrival', 'text' => '(RU) Arrival', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_arrival', 'text' => '(GR) Arrival', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_status', 'text' => 'Status', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_status', 'text' => '(RU) Status', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_status', 'text' => '(GR) Status', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_limit', 'text' => 'Limit', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_limit', 'text' => '(RU) Limit', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_limit', 'text' => '(GR) Limit', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_time_to_departure', 'text' => 'Time to ETD', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_time_to_departure', 'text' => '(RU) Time to ETD', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_time_to_departure', 'text' => '(GR) Time to ETD', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_time_to_arrival', 'text' => 'Time to arrival', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_time_to_arrival', 'text' => '(RU) Time to arrival', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_time_to_arrival', 'text' => '(GR) Time to arrival', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'ui_caption_next_events', 'text' => 'Next events', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'ui_caption_next_events', 'text' => '(RU) Next events', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'ui_caption_next_events', 'text' => '(GR) Next events', 'created_at' => $date, 'updated_at' => $date]
        ];

        InterfaceElements::insert($uiElements);
        Translations::insert($translations);
    }
}
