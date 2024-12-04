<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Gates
 * @package App\Models
 */
class Gates extends MainModel
{
    use SoftDeletes;

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
