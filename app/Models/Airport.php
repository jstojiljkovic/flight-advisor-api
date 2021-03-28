<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Airport
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $country
 * @property string|null $iata
 * @property string|null $icao
 * @property string $latitude
 * @property string $longitude
 * @property int $altitude
 * @property string|null $timezone
 * @property string|null $dst
 * @property string|null $tz
 * @property string $type
 * @property string $source
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereAltitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereDst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereIata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereIcao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Airport whereTz($value)
 * @mixin \Eloquent
 */
class Airport extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'city',
        'country',
        'iata',
        'icao',
        'latitude',
        'longitude',
        'altitude',
        'timezone',
        'dst',
        'tz',
        'type',
        'source',
    ];
}
