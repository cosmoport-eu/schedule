<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Statuses
 * @package App\Models
 *
 * @property int $id
 * @property string $i18n_name_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Statuses newModelQuery()
 * @method static Builder|Statuses newQuery()
 * @method static \Illuminate\Database\Query\Builder|Statuses onlyTrashed()
 * @method static Builder|Statuses query()
 * @method static Builder|Statuses whereId($value)
 * @method static Builder|Statuses whereI18nNameCode($value)
 * @method static Builder|Statuses whereCreatedAt($value)
 * @method static Builder|Statuses whereUpdatedAt($value)
 * @method static Builder|Statuses whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Statuses withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Statuses withoutTrashed()
 */
class Statuses extends MainModel
{
    use SoftDeletes;

    const CANCELLED = 1;
    const   WAITING = 2;
    const  BOARDING = 3;
    const  DEPARTED = 4;
    const RETURNING = 5;
    const  RETURNED = 6;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ['id'];

    /**
     * @return HasOne
     */
    public function translationEn()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(1);
    }

    /**
     * @return HasOne
     */
    public function translationRu()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(2);
    }

    /**
     * @return HasOne
     */
    public function translationGr()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(3);
    }
}
