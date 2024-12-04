<?php

namespace Database\Seeders;

use App\Models\Locales;
use App\Models\Translations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TranslationsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $locales = [
            ['code' => 'en', 'description' => 'English', 'show_time' => 10, 'is_default' => true, 'created_at' => $date, 'updated_at' => $date],
            ['code' => 'ru', 'description' => 'Russian', 'show_time' => 10, 'is_default' => false, 'created_at' => $date, 'updated_at' => $date],
            ['code' => 'gr', 'description' => 'Greek', 'show_time' => 10, 'is_default' => false, 'created_at' => $date, 'updated_at' => $date]
        ];

        $translations = [
            // Categories
            ['locale_id' => 1, 'code' => 'category_1', 'text' => 'Birthday Party', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'category_1', 'text' => 'День Рождения', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'category_1', 'text' => '(GR) Birthday Party', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'category_2', 'text' => 'Masterclass', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'category_2', 'text' => 'Мастеркласс', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'category_2', 'text' => '(GR) Masterclass', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'category_3', 'text' => 'Exclusive booking', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'category_3', 'text' => 'Эксклюзивное бронирование', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'category_3', 'text' => '(GR) Exclusive booking', 'created_at' => $date, 'updated_at' => $date],

            // Type names
            ['locale_id' => 1, 'code' => 'type_1', 'text' => 'Standard', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_1', 'text' => 'Стандартный пакет', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_1', 'text' => '(GR) Standard', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_2', 'text' => 'Piloting lessons', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_2', 'text' => 'Уроки пилотирования', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_2', 'text' => '(GR) Piloting lessons', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_3', 'text' => 'Lesson 1: Introduction', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_3', 'text' => 'Урок 1: Введение', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_3', 'text' => 'Μάθημα 1: Εισαγωγή', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_4', 'text' => 'Lesson 2: Basic training', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_4', 'text' => 'Урок 2: Базовый трейнинг', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_4', 'text' => 'Μάθημα 2: Βασική εκπαίδευση', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_5', 'text' => 'Lesson 3: Advanced training', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_5', 'text' => 'Урок 3: Продвинутая подготовка', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_5', 'text' => 'Μάθημα 3: Προχωρημένη εκπαίδευση', 'created_at' => $date, 'updated_at' => $date],

            // Type Descriptions
            ['locale_id' => 1, 'code' => 'type_6', 'text' => '(RU) Описание Для Стандартного дня рождения.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_6', 'text' => '(EN) Описание Для Стандартного дня рождения.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_6', 'text' => '(GR) Описание Для Стандартного дня рождения.', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_7', 'text' => '(RU) Описание Для Эксклюзивного Бронирования.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_7', 'text' => '(EN) Описание Для Эксклюзивного Бронирования.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_7', 'text' => '(GR) Описание Для Эксклюзивного Бронирования.', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_8', 'text' => 'This quick lesson will provide you with some basic information you need to get started.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_8', 'text' => 'Этот быстрый урок предоставит вам некоторую базовую информацию, необходимую для начала работы.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_8', 'text' => 'Αυτό το γρήγορο μάθημα θα σας δώσει μερικές βασικές πληροφορίες που χρειάζεστε για να ξεκινήσετε.', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_9', 'text' => 'Learn to fly! Here is what you need to know before taking your first flight lesson.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_9', 'text' => 'Учиться летать! Вот что вам нужно знать, прежде чем взять первый урок полета.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_9', 'text' => 'Μαθαίνω να πετάω! Εδώ είναι τι πρέπει να γνωρίζετε πριν κάνετε το πρώτο σας μάθημα πτήσης.', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'type_10', 'text' => 'This training designed to enable flight crews to respond to challenging situations and achieve the highest level of safety, while developing solid flying skills, swift and accurate decisions, and precise crew communication.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'type_10', 'text' => 'Это обучение предназначено для того, чтобы летные экипажи могли реагировать на сложные ситуации и достигать высочайшего уровня безопасности, одновременно развивая прочные летные навыки, быстрые и точные решения и четкое общение с экипажем.', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'type_10', 'text' => 'Αυτή η εκπαίδευση έχει σχεδιαστεί για να επιτρέπει στα πληρώματα πτήσης να ανταποκρίνονται σε δύσκολες καταστάσεις και να επιτυγχάνουν το υψηλότερο επίπεδο ασφάλειας, αναπτύσσοντας ταυτόχρονα ισχυρές πτητικές δεξιότητες, γρήγορες και ακριβείς αποφάσεις και ακριβή επικοινωνία του πληρώματος.', 'created_at' => $date, 'updated_at' => $date],
            
            // Statuses
            ['locale_id' => 1, 'code' => 'status_1', 'text' => 'Canceled', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_1', 'text' => 'Отменен', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_1', 'text' => 'Ακυρώθηκε', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'status_2', 'text' => 'Waiting', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_2', 'text' => 'Ожидание', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_2', 'text' => '(GR) Waiting', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'status_3', 'text' => 'Boarding', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_3', 'text' => 'Посадка', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_3', 'text' => 'Eπιβίβασης', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'status_4', 'text' => 'Departed', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_4', 'text' => 'Отправлен', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_4', 'text' => 'Περασμένος', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'status_5', 'text' => 'Return', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_5', 'text' => 'Возвращается', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_5', 'text' => 'Επιστροφές', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'status_6', 'text' => 'Returned', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'status_6', 'text' => 'Вернулся', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'status_6', 'text' => 'Eπέστρεψαν', 'created_at' => $date, 'updated_at' => $date],
            
            // Gates
            ['locale_id' => 1, 'code' => 'gate_1', 'text' => 'Birthday Room', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'gate_1', 'text' => 'Комната для Дней рождения', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'gate_1', 'text' => '(GR) Birthday Room', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'gate_2', 'text' => 'Masterclass Room', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'gate_2', 'text' => 'Комната для Мастерклассов', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'gate_2', 'text' => '(GR) Masterclass Room', 'created_at' => $date, 'updated_at' => $date],
            
            ['locale_id' => 1, 'code' => 'gate_3', 'text' => 'VR Pilot', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'gate_3', 'text' => 'VR Пилот', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'gate_3', 'text' => '(GR) VR Pilot', 'created_at' => $date, 'updated_at' => $date],

            // Facilities
            ['locale_id' => 1, 'code' => 'facility_1', 'text' => '(EN) VR Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_1', 'text' => '(RU) VR Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_1', 'text' => '(GR) VR Zone', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'facility_2', 'text' => '(EN) IR Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_2', 'text' => '(RU) IR Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_2', 'text' => '(GR) IR Zone', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'facility_3', 'text' => '(EN) Lounge Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_3', 'text' => '(RU) Lounge Zone', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_3', 'text' => '(GR) Lounge Zone', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'facility_4', 'text' => '(EN) Sandbox', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_4', 'text' => '(RU) Sandbox', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_4', 'text' => '(GR) Sandbox', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'facility_5', 'text' => '(EN) Claw Machine', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_5', 'text' => '(RU) Claw Machine', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_5', 'text' => '(GR) Claw Machine', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'facility_6', 'text' => '(EN) Soft Cinema', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'facility_6', 'text' => '(RU) Soft Cinema', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'facility_6', 'text' => '(GR) Soft Cinema', 'created_at' => $date, 'updated_at' => $date],

            // Materials
            ['locale_id' => 1, 'code' => 'material_1', 'text' => '(EN) Water', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'material_1', 'text' => '(RU) Water', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'material_1', 'text' => '(GR) Water', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'material_2', 'text' => '(EN) Apple Juice', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'material_2', 'text' => '(RU) Apple Juice', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'material_2', 'text' => '(GR) Apple Juice', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'material_3', 'text' => '(EN) Cake from Sweet Nest', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'material_3', 'text' => '(RU) Cake from Sweet Nest', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'material_3', 'text' => '(GR) Cake from Sweet Nest', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'material_4', 'text' => '(EN) Coca-Cola', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'material_4', 'text' => '(RU) Coca-Cola', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'material_4', 'text' => '(GR) Coca-Cola', 'created_at' => $date, 'updated_at' => $date],

            ['locale_id' => 1, 'code' => 'material_5', 'text' => '(EN) Pizza', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 2, 'code' => 'material_5', 'text' => '(RU) Pizza', 'created_at' => $date, 'updated_at' => $date],
            ['locale_id' => 3, 'code' => 'material_5', 'text' => '(GR) Pizza', 'created_at' => $date, 'updated_at' => $date]
        ];

        Locales::insert($locales);
        Translations::insert($translations);
    }
}
