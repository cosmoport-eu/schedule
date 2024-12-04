<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Translations
 * @package App\Models
 *
 * @property int $id
 * @property int $locale_id
 * @property string $code
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Translations newModelQuery()
 * @method static Builder|Translations newQuery()
 * @method static \Illuminate\Database\Query\Builder|Translations onlyTrashed()
 * @method static Builder|Translations query()
 * @method static Builder|Translations whereId($value)
 * @method static Builder|Translations whereLocaleId($value)
 * @method static Builder|Translations whereCode($value)
 * @method static Builder|Translations whereText($value)
 * @method static Builder|Translations whereCreatedAt($value)
 * @method static Builder|Translations whereUpdatedAt($value)
 * @method static Builder|Translations whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Translations withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Translations withoutTrashed()
 */
class Translations extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locale_id', 'code', 'text'];
}
