<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Carbon\Carbon;
use App\Traits\SmsTrait;
use App\Traits\UploadTrait;
use App\Services\Sms\SmsService;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AuthBaseModel extends Authenticatable
{
    use Notifiable, UploadTrait, HasApiTokens, SmsTrait, SoftDeletes, SearchTrait, HasFactory;

    const IMAGEPATH = 'users';

    protected $hidden = [
        'password',
    ];

	public function getGuardTextAttribute()
	{
		return __('enums.guards.'.strtolower(class_basename($this)));
	}

    public function setPhoneAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['phone'] = fixPhone($value);
        }
    }

    public function setCountryCodeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['country_code'] = fixPhone($value);
        }
    }

    public function getFullPhoneAttribute()
    {
        return $this->attributes['country_code'] . $this->attributes['phone'];
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], self::IMAGEPATH);
        } else {
            $image = $this->defaultImage(self::IMAGEPATH);
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], self::IMAGEPATH) : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, self::IMAGEPATH);
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    public function markAsActive()
    {
        $this->update(['code' => null, 'code_expire' => null, 'active' => true]);
        return $this;
    }

    public function sendVerificationCode()
    {
        $this->update([
            'code'        => $this->activationCode(),
            'code_expire' => Carbon::now()->addMinute(),
        ]);
        $this->sendCodeAtSms($this->code);
        return ['user' => $this];
    }

    private function activationCode()
    {
        return 1234;
        return mt_rand(1111, 9999);
    }

    public function sendCodeAtSms($code, $full_phone = null)
    {
        (new SmsService())->sendSms($full_phone ?? $this->full_phone, trans('api.activeCode') . $code);
    }

    public function devices()
    {
        return $this->morphMany(Device::class, 'morph');
    }

    public function login()
    {
        // $this->tokens()->delete();
        $this->updateDevice();
        $this->updateLang();
        $token = $this->createToken(request()->device_type)->plainTextToken;
        return $token;
    }

    public function updateLang()
    {
        if (request()->header('Lang') != null
            && in_array(request()->header('Lang'), languages())) {
            $this->update(['lang' => request()->header('Lang')]);
        } else {
            $this->update(['lang' => defaultLang()]);
        }
    }

    public function updateDevice()
    {
        if (request()->device_id) {
            $this->devices()->updateOrCreate([
                'device_id'   => request()->device_id,
                'device_type' => request()->device_type,
            ]);
        }
    }


    public function logout()
    {
        // $this->tokens()->delete();
        $this->currentAccessToken()->delete();
        if (request()->device_id) {
            $this->devices()->where(['device_id' => request()->device_id])->delete();
        }
        return true;
    }


    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable');
    }

    public function ownRooms()
    {
        return $this->morphMany(Room::class, 'createable');
    }

    public function joinedRooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable')
            ->with('room')
            ->get()
            ->sortByDesc('room.last_message_id')
            ->pluck('room');
    }

    public function replays()
    {
        return $this->morphMany(ComplaintReplay::class, 'replayer');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable')->latest();
    }

    public function settlements()
    {
        return $this->morphMany(Settlement::class, 'transactionable')->latest();
    }

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'walletable')->latest();
    }

    /**
     * Get all of the complaints for the AuthBaseModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'user_id', 'id');
    }

	public static function boot ()
	{
		parent::boot();
		/* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */
		static::deleted( function ($model) {
			$model->deleteFile( $model->id . '.png', static::IMAGEPATH );
		} );

		static::created( function ($model) {
			$model->wallet()->create();
		} );

		static::updating( function ($model) {
			$model->deleteFile( $model->id . '.png', static::IMAGEPATH );
		} );
	}


}