<?php

namespace ExclusiveDev\FileLeech\Contracts;

/**
 * Attachment auth policy
 *
 * Interface IAttachmentPolicy
 * @package ExclusiveDev\FileLeech\Contracts
 */
interface AttachmentPolicy
{
    public function store($user);    

    public function delete($user, Attachment $attachment);
}