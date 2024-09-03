<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
	protected $fillable = [
		'tracking_code',
		'mobile',
		'file_id'
	];

	public function file(): BelongsTo
	{
		return $this->belongsTo(File::class);
	}
}
