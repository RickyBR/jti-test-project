<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\PhoneNumber;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PhoneNumber
 * 
 * @property uuid $id
 * @property int $phone_number
 * @property string $operator
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class PhoneNumber extends Model
{
	use HasUuids, SoftDeletes;
	protected $table = 'phone_numbers';
	public $incrementing = false;

	protected $casts = [
		
	];

	protected $fillable = [
		'phone_number',
		'operator'
	];
}
