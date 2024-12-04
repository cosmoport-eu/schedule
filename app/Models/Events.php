<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Class Events
 * @package App\Models
 *
 * @property int $id
 * @property Carbon $date
 * @property string $time_start
 * @property string $time_end
 * @property string $description
 * @property int $duration
 * @property int $type_id
 * @property int $status_id
 * @property int $departure_gate_id
 * @property int $arrival_gate_id
 * @property int $people_limit
 * @property int $contestants
 * @property float $cost
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|Events whereId($value)
 * @method static Builder|Events whereDate($value)
 * @method static Builder|Events whereTimeStart($value)
 * @method static Builder|Events whereTimeEnd($value)
 * @method static Builder|Events whereDescription($value)
 * @method static Builder|Events whereDuration($value)
 * @method static Builder|Events whereTypeId($value)
 * @method static Builder|Events whereStatusId($value)
 * @method static Builder|Events whereDepartureGateId($value)
 * @method static Builder|Events whereArrivalGateId($value)
 * @method static Builder|Events wherePeopleLimit($value)
 * @method static Builder|Events whereContestants($value)
 * @method static Builder|Events whereCost($value)
 *
 * @method static Builder|Events whereCreatedAt($value)
 * @method static Builder|Events whereUpdatedAt($value)
 * @method static Builder|Events whereDeletedAt($value)
 *
 * @method static Builder|Events newModelQuery()
 * @method static Builder|Events newQuery()
 * @method static Builder|Events query()
 *
 * @method static Builder|Events withTrashed()
 * @method static Builder|Events withoutTrashed()
 * @method static Builder|Events onlyTrashed()
 */
class Events extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'time_start', 'time_end', 'description', 'duration', 'type_id', 'status_id',
        'departure_gate_id', 'arrival_gate_id', 'people_limit', 'contestants', 'cost'];

    /**
     * @return HasOne
     */
    public function type()
    {
        return $this->hasOne(Types::class, 'id', 'type_id');
    }

    /**
     * @return HasOne
     */
    public function status()
    {
        return $this->hasOne(Statuses::class, 'id', 'status_id');
    }

    /**
     * @return HasOne
     */
    public function departureGate()
    {
        return $this->hasOne(Gates::class, 'id', 'departure_gate_id');
    }

    /**
     * @return HasOne
     */
    public function typeEn()
    {
        return $this->hasOne(Types::class, 'id', 'type_id')
            ->with('categoryEn', 'nameTranslationEn', 'descrTranslationEn');
    }

    /**
     * @return HasOne
     */
    public function statusEn()
    {
        return $this->hasOne(Statuses::class, 'id', 'status_id')
            ->with('translationEn');
    }

    /**
     * @return HasOne
     */
    public function departureGateEn()
    {
        return $this->hasOne(Gates::class, 'id', 'departure_gate_id')
            ->with('translationEn');
    }

    /**
     * @return HasOne
     */
    public function arrivalGateEn()
    {
        return $this->hasOne(Gates::class, 'id', 'arrival_gate_id')
            ->with('translationEn');
    }
}
