<?php

namespace ExclusiveDev\FileLeech\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Add this trait to any model that you want to be able to
 * comment upon or get comments for.
 */
trait Attachable
{
    /**
     * @return bool
     */

    public function isAttachable(): bool
    {
        return true;
    }

    /**
     * Returns all attachments for this model.
     */
    public function attachments() : MorphMany
    {
        return $this->morphMany(config('attachments.models.attachment'), 'attachable')->with('attacher.person');
    }

	public function getEncryptedKey()
	{
		return encrypt(['type' => get_class($this), 'id' => $this->attributes['id']]);
	}
}
