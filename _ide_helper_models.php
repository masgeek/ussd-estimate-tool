<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Project
 *
 */
	class Project extends \Eloquent {}
}

namespace App{
/**
 * App\PlantingDate
 *
 * @property int $id
 * @property string $display
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlantingDate whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlantingDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PlantingDate whereValue($value)
 */
	class PlantingDate extends \Eloquent {}
}

namespace App{
/**
 * App\HarvestingDate
 *
 * @property int $id
 * @property string $display
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HarvestingDate whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HarvestingDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\HarvestingDate whereValue($value)
 */
	class HarvestingDate extends \Eloquent {}
}

namespace App{
/**
 * App\UnitOfSale
 *
 * @property int $id
 * @property string $display
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitOfSale whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitOfSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitOfSale whereValue($value)
 */
	class UnitOfSale extends \Eloquent {}
}

namespace App{
/**
 * App\SubLocation
 *
 * @property-read \App\Location $location
 */
	class SubLocation extends \Eloquent {}
}

namespace App{
/**
 * App\FieldArea
 *
 * @property int $id
 * @property string $display
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FieldArea whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FieldArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FieldArea whereValue($value)
 */
	class FieldArea extends \Eloquent {}
}

namespace App{
/**
 * App\SmsMessage
 *
 * @mixin \Eloquent
 */
	class SmsMessage extends \Eloquent {}
}

namespace App{
/**
 * App\Fertilizer
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fertilizer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fertilizer whereName($value)
 */
	class Fertilizer extends \Eloquent {}
}

namespace App{
/**
 * App\Location
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SubLocation[] $subLocations
 * @property-read \App\Ward $ward
 */
	class Location extends \Eloquent {}
}

namespace App{
/**
 * App\FinancialYear
 *
 */
	class FinancialYear extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\PriceRange
 *
 * @property int $id
 * @property string $min
 * @property int $max
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PriceRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PriceRange whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PriceRange whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PriceRange whereValue($value)
 */
	class PriceRange extends \Eloquent {}
}

namespace App{
/**
 * App\Investment
 *
 * @property int $id
 * @property int $amount
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Investment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Investment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Investment whereValue($value)
 */
	class Investment extends \Eloquent {}
}

namespace App{
/**
 * App\SessionConfig
 *
 * @property int $id
 * @property int|null $session_id
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SessionConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SessionConfig whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SessionConfig whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SessionConfig whereValue($value)
 */
	class SessionConfig extends \Eloquent {}
}

namespace App{
/**
 * App\UnitPrice
 *
 * @property int $id
 * @property int $min
 * @property int $max
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitPrice whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitPrice whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UnitPrice whereValue($value)
 */
	class UnitPrice extends \Eloquent {}
}

namespace App{
/**
 * App\FertilizerPriceRange
 *
 * @property int $id
 * @property int $session_id
 * @property int $fertilizer_id
 * @property int|null $price_range_id
 * @property-read \App\Fertilizer $fertilizer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FertilizerPriceRange whereFertilizerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FertilizerPriceRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FertilizerPriceRange wherePriceRangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FertilizerPriceRange whereSessionId($value)
 */
	class FertilizerPriceRange extends \Eloquent {}
}

namespace App{
/**
 * App\USSDSession
 *
 * @property int $id
 * @property string|null $session_id
 * @property string $path
 * @property string $phone_no
 * @property int|null $planting_date_id
 * @property int|null $field_area_id
 * @property int|null $harvesting_date_id
 * @property int|null $unit_of_sale_id
 * @property int|null $unit_price_id
 * @property int|null $investment_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\FieldArea|null $fieldArea
 * @property-read \App\HarvestingDate|null $harvestDate
 * @property-read \App\Investment|null $investment
 * @property-read \App\PlantingDate|null $plantingDate
 * @property-read \App\UnitOfSale|null $unitOfSale
 * @property-read \App\UnitPrice|null $unitPrice
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereFieldAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereHarvestingDateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereInvestmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession wherePhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession wherePlantingDateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereUnitOfSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereUnitPriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereUpdatedAt($value)
 */
	class USSDSession extends \Eloquent {}
}

namespace App{
/**
 * App\Ward
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Location[] $locations
 */
	class Ward extends \Eloquent {}
}

