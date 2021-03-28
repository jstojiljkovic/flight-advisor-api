<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Route
 *
 * @property int $id
 * @property string $airline
 * @property int|null $airline_id
 * @property string $source
 * @property int|null $source_id
 * @property string $destination
 * @property int|null $destination_id
 * @property string $codeshare
 * @property int $stops
 * @property string $equipment
 * @property string $price
 * @method static \Illuminate\Database\Eloquent\Builder|Route newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Route newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Route query()
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereAirline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereAirlineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereCodeshare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereDestinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Route whereStops($value)
 * @mixin \Eloquent
 */
class Route extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'airline',
        'airline_id',
        'source',
        'source_id',
        'destination',
        'destination_id',
        'codeshare',
        'stops',
        'equipment',
        'price',
    ];
}
