<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Class Statuses
 * @package App\Models
 *
 * @property int $id
 * @property string $parameter
 * @property array|null $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|Statuses whereId($value)
 * @method static Builder|Statuses whereParameter($value)
 * @method static Builder|Statuses whereValue($value)
 * @method static Builder|Statuses whereCreatedAt($value)
 * @method static Builder|Statuses whereUpdatedAt($value)
 * @method static Builder|Statuses whereDeletedAt($value)
 *
 * @method static Builder|Statuses newModelQuery()
 * @method static Builder|Statuses newQuery()
 * @method static Builder|Statuses query()
 *
 * @method static \Illuminate\Database\Query\Builder|Statuses withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Statuses withoutTrashed()
 * @method static \Illuminate\Database\Query\Builder|Statuses onlyTrashed()
 */
class Settings extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parameter', 'value'];

    /**
     * @var array
     */
    public $casts = ['value' => 'array'];
}
