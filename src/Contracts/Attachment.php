<?php

namespace ExclusiveDev\FileLeech\Contracts;

interface Attachment
{    
    /**
     * The user who attached the file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attacher();

    /**
     * The model that owns the attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachable();
    
}
