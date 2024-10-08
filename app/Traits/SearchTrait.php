<?php
namespace App\Traits;
use Illuminate\Support\Carbon;

trait  SearchTrait
{
	use UploadTrait;

	public function scopeSearch($query, $request)
	{
		$query
			->when($request->q != null, function ($q) use ($request) {
				$q->whereLike(static::searchAttributes, $request->q);
			})
			->when($request->created_at_min != null, function ($q) use ($request) {
				$date = Carbon::createFromFormat('m-d-Y', $request->created_at_min);
				$q->WhereDate('created_at', '>=', $date->format('Y-m-d'));
			})
			->when($request->created_at_max != null, function ($q) use ($request) {
				$date = Carbon::createFromFormat('m-d-Y', $request->created_at_max);
				$q->WhereDate('created_at', '<=', $date->format('Y-m-d'));
			});

		$searchArrayExcept = $request->except(['q', 'order', 'created_at_min', 'created_at_max', '_', 'page']);

		foreach ($searchArrayExcept as $key => $value) {
			if ($value != null) {
				$query->Where($key, $value);
			}
		}

		return $query->orderBy('created_at', strtoupper($request->order) == "ASC" ? "ASC" : 'DESC');
	}

	/**
	 * Get the avatar attribute.
	 *
	 * If the avatar attribute is already set, retrieve the avatar.
	 * If the avatar attribute is not set, save the avatar and then retrieve the avatar.
	 *
	 * @return string The avatar file path
	 */
	public function getAvatarAttribute()
	{
		if ($this->attributes['avatar'] != null) {
			// If the avatar attribute is already set, retrieve the avatar
			$avatar = $this->getImage($this->attributes['avatar'], static::IMAGEPATH);
		} else {
			// If the avatar attribute is not set, save the avatar and then retrieve the avatar
			$this->saveAvatar($this->name, static::IMAGEPATH, $this->attributes['id']);
			$avatar = $this->getImage($this->attributes['id'] . '.png', static::IMAGEPATH);
		}

		return $avatar;
	}

	/**
	 * Set the avatar attribute.
	 *
	 * If the avatar attribute is already set, delete the old avatar.
	 * If the avatar attribute is not set, upload the new avatar and set the attribute.
	 *
	 * @param string $value The avatar file path
	 *
	 * @return void
	 */
	public function setAvatarAttribute($value)
	{
		if (isset($value)) {
			// If the avatar attribute is already set, delete the old avatar
			if (isset($this->attributes['avatar'])) {
				$this->deleteFile($this->attributes['avatar'], static::IMAGEPATH);
			}

			// If the avatar attribute is not set, upload the new avatar and set the attribute
			$this->attributes['avatar'] = $this->uploadAllTyps($value, static::IMAGEPATH);
		}
	}

	public function getImageAttribute()
	{
		if ($this->attributes['image']) {
			$image = $this->getImage($this->attributes['image'], static::IMAGEPATH);
		} else {
			$image = $this->defaultImage(static::IMAGEPATH);
		}
		return $image;
	}

	public function setImageAttribute($value)
	{
		if (isset($value)) {
			if(!is_file($value) && !empty($value)){

				$this->attributes['image'] = $value;
				return $value;
			}
			// If the image attribute is already set, delete the old image
			if (isset($this->attributes['image'])) {
				$this->deleteFile($this->attributes['image'], static::IMAGEPATH);
			}

			// If the image attribute is not set, upload the new image and set the attribute
			$this->attributes['image'] = $this->uploadAllTyps($value, static::IMAGEPATH);
		}

	}

	public function getVideoAttribute() {
		if ($this->attributes['video']) {
			$video         = $this->getVideo($this->attributes['video'], static::IMAGEPATH);
		} else {
			$video         = $this->defaultVideo( static::IMAGEPATH);
		}
		return $video;
	}

	public function setVideoAttribute($value) {
		if (null != $value && is_file($value) ) {
			isset($this->attributes['video']) ? $this->deleteVideo($this->attributes['video'] , static::IMAGEPATH) : '';
			$this->attributes['video'] = $this->uploadFile($value, static::IMAGEPATH);
		}
	}


	public function getCoverAttribute() {
		if ($this->attributes['cover']) {
			$image = $this->getImage($this->attributes['cover'], static::COVERPATH);
		} else {
			$image = $this->defaultCover( static::COVERPATH);
		}
		return $image;
	}

	public function setCoverAttribute($value)
	{

		if(!empty($value)){
			$this->attributes['cover'] = $this->uploadeImageBase64($value, static::COVERPATH);
		}
	}

	protected function asJson($value)
	{
		return json_encode($value, JSON_UNESCAPED_UNICODE);
	}

	public function getCreatedAtFormatAttribute()
	{
		return Carbon::parse($this->created_at)->translatedFormat('j F Y g:i A');
	}
}
