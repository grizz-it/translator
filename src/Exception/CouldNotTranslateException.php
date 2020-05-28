<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Exception;

use Exception;

class CouldNotTranslateException extends Exception
{
    /**
     * Constructor.
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        parent::__construct(sprintf(
            'Could not translate %s.',
            $input
        ));
    }
}
