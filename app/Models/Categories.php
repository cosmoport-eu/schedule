<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categories
 * @package App\Models
 */
class Categories extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function typesEn()
    {
        return $this->hasMany(Types::class, 'i18n_category_code', 'i18n_name_code')
            ->whereParentId(0)
            ->with('nameTranslationEn');
    }

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
