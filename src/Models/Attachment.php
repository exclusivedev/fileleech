<?php

namespace ExclusiveDev\FileLeech\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ExclusiveDev\FileLeech\Contracts\Attachment as IAttachment;
use ExclusiveDev\FileLeech\Events\AttachmentCreated;
use ExclusiveDev\FileLeech\Events\AttachmentDeleted;

class Attachment extends Model implements IAttachment
{
    use SoftDeletes;

    const UPDATED_AT = null;

    protected $guarded = [''];

    protected $dispatchesEvents = [
        'created' => AttachmentCreated::class,
        'deleted' => AttachmentDeleted::class,
    ];

    protected $dates = ['deleted_at', 'created_at'];

    /**
     * The user who attached the file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attacher()
    {
        return $this->belongsTo(config('attachments.models.attacher'));
    }

    /**
     * The model that owns the attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable()
    {
        return $this->morphTo();
    }
    
}
