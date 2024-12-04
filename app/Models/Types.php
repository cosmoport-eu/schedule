<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Types
 * @package App\Models
 */
class Types extends MainModel
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
//    protected $fillable = ['parent_id', 'i18n_category_code', 'i18n_name_code', 'i18n_description_code'
//        ,'default_participants_number', 'default_duration', 'default_cost', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasOne
     */
    public function parent()
    {
        return $this->hasOne(Types::class, 'id', 'parent_id')
            ->with('categoryEn', 'nameTranslationEn', 'descrTranslationEn');
    }

    /**
     * @return BelongsToMany
     */
    public function facilities()
    {
        return $this->belongsToMany(Facilities::class, 'type_facilities');
    }

    /**
     * @return BelongsToMany
     */
    public function materials()
    {
        return $this->belongsToMany(Materials::class, 'type_materials');
    }

    /**
     * @return HasMany
     */
    public function subtypesEn()
    {
        return $this->hasMany(Types::class, 'parent_id', 'id')
            ->with('categoryEn', 'nameTranslationEn', 'descrTranslationEn');
    }

    /**
     * @return HasOne
     */
    public function category()
    {
        return $this->hasOne(Categories::class, 'i18n_name_code', 'i18n_category_code');
    }

    /**
     * @return HasOne
     */
    public function categoryEn()
    {
        return $this->hasOne(Categories::class, 'i18n_name_code', 'i18n_category_code')
            ->with('translationEn');
    }

    /**
     * @return HasOne
     */
    public function nameTranslationEn()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(1);
    }

    /**
     * @return HasOne
     */
    public function nameTranslationRu()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(2);
    }

    /**
     * @return HasOne
     */
    public function nameTranslationGr()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_name_code')
            ->whereLocaleId(3);
    }

    /**
     * @return HasOne
     */
    public function descrTranslationEn()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_description_code')
            ->whereLocaleId(1);
    }

    /**
     * @return HasOne
     */
    public function descrTranslationRu()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_description_code')
            ->whereLocaleId(2);
    }

    /**
     * @return HasOne
     */
    public function descrTranslationGr()
    {
        return $this->hasOne(Translations::class, 'code', 'i18n_description_code')
            ->whereLocaleId(3);
    }
}
