<?php

namespace ExclusiveDev\FileLeech\Events;

use Illuminate\Queue\SerializesModels;
use ExclusiveDev\FileLeech\Models\Attachment;

class AttachmentDeleted
{
    use SerializesModels;

    public $attachment;

    /**
     * AttachmentDeleted constructor.
     * @param Attachment $comment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }
}
