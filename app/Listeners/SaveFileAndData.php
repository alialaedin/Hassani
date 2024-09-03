<?php

namespace App\Listeners;

use App\Events\UploadFile;
use App\Imports\CustomersImport;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SaveFileAndData
{
	private String $extension;
	private array $attributes;

	public function __construct()
	{
		$this->extension = File::FILE_EXTENSION;
	}

	public function handle(UploadFile $event): void
	{
		$this->updateAttributs($event->file);
		$file = File::query()->create($this->attributes);
		Excel::import(new CustomersImport($file->id), $event->file);
	}

	private function updateAttributs($file): void
	{
		$this->attributes = [
			'name' =>  Str::remove($this->extension, $file->getClientOriginalName()),
			'path' => Storage::disk('local')->put('files', $file),
			'is_send' => 0
		];
	}
}
