<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property \App\Enums\AccountType $account_type
 * @property \App\Enums\Currency $currency
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount withoutTrashed()
 */
	class BankAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property \App\Enums\CategoryType $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category type(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $contactable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo createdAtDateRange($from, $to = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo updatedAtDateRange($from, $to = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactInfo withoutTrashed()
 */
	class ContactInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property \App\Enums\CustomerStatus $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactInfo> $contactInfos
 * @property-read int|null $contact_infos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $noteable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note withoutTrashed()
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Unit|null $unit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product barcode(string $barcode)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product expired()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product inStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product outOfStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactInfo> $contactInfos
 * @property-read int|null $contact_infos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withoutTrashed()
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction withoutTrashed()
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit createdAtDateRange($from, $to = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit updatedAtDateRange($from, $to = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Unit withoutTrashed()
 */
	class Unit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BankAccount> $bankAccounts
 * @property-read int|null $bank_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Customer> $customers
 * @property-read int|null $customers_count
 * @property-read \App\Models\UserLoginActivity|null $lastLogin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserLoginActivity> $loginActivities
 * @property-read int|null $login_activities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Supplier> $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Unit> $units
 * @property-read int|null $units_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLoginActivity withoutTrashed()
 */
	class UserLoginActivity extends \Eloquent {}
}

