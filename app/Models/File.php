<?php

namespace App\Models;

use App\Events\UploadFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\ValidationException;

class File extends Model
{
  public const FILE_NAME = 'excel_file';
  public const MAX_FILE_SIZE = '10240';
  public const MIN_FILE_SIZE = '1';
  public const ACCEPT_MIME = 'xlsx';
  public const FILE_EXTENSION = '.xlsx';
  public const FAILED_MESSAGE = 'خطا در آپلود فایل';

  protected $fillable = ['name', 'path', 'is_send'];

  public static function booted(): void 
  {
    static::created(fn() => toastr()->success('فایل با موفقیت بارگذاری شد'));
  }

  public static function uploadFile($request)
  {
    $isValid = static::validateFile($request);
    if ($isValid) { 
      Event::dispatch(new UploadFile($request->file(static::FILE_NAME)));
    } else {
      (new File)->throwValidationError();
    }
  }

  private static function validateFile($request): bool
  {
    if ($request->hasFile(static::FILE_NAME) && $request->file(static::FILE_NAME)->isValid()) {
      return true;
    } else {
      return false;
    }
  }

  public function throwValidationError(): ValidationException
  {
    return ValidationException::withMessages([
      static::FILE_NAME => static::FAILED_MESSAGE
    ])->errorBag('default');
  }

  public function customers(): HasMany
  {
    return $this->hasMany(Customer::class);
  }

}
