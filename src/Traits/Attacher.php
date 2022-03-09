<?php

namespace ExclusiveDev\FileLeech\Traits;

use ExclusiveDev\FileLeech\Models\Attachment;
use \Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Add this trait to your User model so
 * that you can retrieve the attachments for a user.
 */
trait Attacher
{
    /**
     * Returns all user attachments.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'attacher_id');
    }
    
}
