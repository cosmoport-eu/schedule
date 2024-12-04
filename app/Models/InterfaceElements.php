<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Class InterfaceElements
 * @package App\Models
 *
 * @property int $id
 * @property string $i18n_name_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|InterfaceElements whereId($value)
 * @method static Builder|InterfaceElements whereI18nNameCode($value)
 * @method static Builder|InterfaceElements whereCreatedAt($value)
 * @method static Builder|InterfaceElements whereUpdatedAt($value)
 * @method static Builder|InterfaceElements whereDeletedAt($value)
 *
 * @method static Builder|InterfaceElements newModelQuery()
 * @method static Builder|InterfaceElements newQuery()
 * @method static Builder|InterfaceElements query()
 *
 * @method static \Illuminate\Database\Query\Builder|InterfaceElements withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InterfaceElements onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|InterfaceElements withoutTrashed()
 */
class InterfaceElements extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['i18n_name_code'];

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
