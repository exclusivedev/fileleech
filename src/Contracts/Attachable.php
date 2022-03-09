<?php

namespace ExclusiveDev\FileLeech\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Commentable model Interface
 *
 * Interface ICommentable
 * @package ExclusiveDev\Commenist\Contracts
 */
interface Attachable
{
    public function attachments(): MorphMany;

}