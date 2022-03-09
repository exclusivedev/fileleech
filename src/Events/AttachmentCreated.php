<?php

namespace ExclusiveDev\FileLeech\Events;

use Illuminate\Queue\SerializesModels;
use ExclusiveDev\FileLeech\Models\Attachment;

class AttachmentCreated
{
    use SerializesModels;

    public $attachment;

    /**
     * AttachmentCreated constructor.
     * @param Attachment $comment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }
}
