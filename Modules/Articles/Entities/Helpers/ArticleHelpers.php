<?php

namespace Modules\Articles\Entities\Helpers;

trait ArticleHelpers
{
    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl();
    }
}
