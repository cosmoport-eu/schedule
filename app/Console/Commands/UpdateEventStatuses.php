<?php

namespace App\Console\Commands;

use App\Models\Events;
use App\Models\Settings;
use App\Models\Statuses;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateEventStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statuses for events based on time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
        $today = Carbon::now()->format('Y-m-d');
        $pause = Settings::whereParameter('pause')->first();
        $range = is_null($pause) ? 5 : $pause->value;
        $nowAddedRange = $now->addMinutes($range)->format('Y-m-d H:i:s');

        # если вдруг процедура отрабатывает долго, чтобы был хоть какой-то зазор
        # ну и минимальный промежуток между мероприятиями 5 минут
        $minRange = $range + 5;

        Log::info('Update Statuses', [
            'now' => $now,
            'currentTime' => $currentTime,
            'today' => $today,
            'range' => $range,
            'minRange' => $minRange,
            'time_end >=' => $currentTime,
            'time_end <' => $nowAddedRange
        ]);

        // Обновление статуса на "Идёт посадка" за N минут до начала
        Events::where('date', '=', $today)
            ->whereStatusId(Statuses::WAITING)
            ->whereBetween('time_start', [$nowAddedRange, Carbon::now()->addMinutes($range)->format('Y-m-d H:i:s')])
            ->get()
            ->each(function ($event) {
                Log::info("waiting to boarding: {$event->id} | {$event->time_start} -> {$event->time_end}");
                $event->update(['status_id' => Statuses::BOARDING]);
            });

        // Обновление статуса на "Отправлено" в момент начала
        Events::where('date', '=', $today)
            ->whereStatusId(Statuses::BOARDING)
            ->where('time_start', '<=', $currentTime)
            ->get()
            ->each(function ($event) {
                Log::info("boarding to departed: {$event->id} | {$event->time_start} -> {$event->time_end}");
                $event->update(['status_id' => Statuses::DEPARTED]);
            });

        // Обновление статуса на "Возвращается" за N минут до окончания
        Events::where('date', '=', $today)
            ->whereStatusId(Statuses::DEPARTED)
            ->whereBetween('time_end', [$currentTime, $nowAddedRange])
            ->get()
            ->each(function ($event) use ($now, $range) {
                $ranged_end = Carbon::parse($event->time_end)->subMinutes($range)->format('Y-m-d H:i:s');

                if ($event->time_end <= $now && $now >= $ranged_end) {
                    Log::info("departed to returning: {$event->id} | {$event->time_start} -> {$event->time_end}");
                    $event->update(['status_id' => Statuses::RETURNING]);
                }
            });

        // Обновление статуса на "Вернулся" в момент окончания
        Events::where('date', '=', $today)
            ->whereStatusId(Statuses::RETURNING)
            ->where('time_end', '<=', $currentTime)
            ->get()
            ->each(function ($event) {
                Log::info("returning to returned: {$event->id} | {$event->time_start} -> {$event->time_end}");
                $event->update(['status_id' => Statuses::RETURNED]);
            });

        return 'ok';
    }
}
