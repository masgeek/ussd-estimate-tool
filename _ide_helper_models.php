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
 * @property int $id
 * @property int|null $financial_year_id
 * @property string|null $sector
 * @property int|null $ward_id
 * @property int|null $location_id
 * @property int|null $sub_location_id
 * @property string|null $name
 * @property string|null $activity
 * @property string|null $allocation
 * @property string|null $summary
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereAllocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereFinancialYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereSubLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereWardId($value)
 */
	class Project extends \Eloquent {}
}

namespace App{
/**
 * App\SubLocation
 *
 * @property int $id
 * @property int $location_id
 * @property string $name
 * @property-read \App\Location $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubLocation whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SubLocation whereName($value)
 */
	class SubLocation extends \Eloquent {}
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
 * App\Location
 *
 * @property int $id
 * @property int $ward_id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SubLocation[] $subLocations
 * @property-read \App\Ward $ward
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereWardId($value)
 */
	class Location extends \Eloquent {}
}

namespace App{
/**
 * App\FinancialYear
 *
 * @property int $id
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancialYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FinancialYear whereName($value)
 */
	class FinancialYear extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string|null $username
 * @property string $password
 * @property string|null $activation_token
 * @property string|null $activated_at
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereActivationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\USSDSession
 *
 * @property int $id
 * @property string|null $session_id
 * @property string $path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $phone_no
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession wherePhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\USSDSession whereUpdatedAt($value)
 */
	class USSDSession extends \Eloquent {}
}

namespace App{
/**
 * App\Ward
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Location[] $locations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ward whereName($value)
 */
	class Ward extends \Eloquent {}
}

