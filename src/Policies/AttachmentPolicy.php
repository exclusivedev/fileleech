<?php

namespace ExclusiveDev\FileLeech\Policies;

use ExclusiveDev\FileLeech\Contracts\AttachmentPolicy as IAttachmentPolicy;
use ExclusiveDev\FileLeech\Contracts\Attachment;

class AttachmentPolicy implements IAttachmentPolicy
{
    /**
     * @param $user
     * @return bool
     */
    public function store($user): bool
    {
        return true;
    }

    /**
     * @param $user
     * @param Attachment $attachment
     * @return bool
     */
    public function delete($user, Attachment $attachment): bool
    {
        return $user->id === $attachment->attacher_id;
    }
}