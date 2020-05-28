<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Common;

interface ArrayTranslatorInterface extends TranslatorInterface
{
    /**
     * Retrieves all translations from the left to right.
     *
     * @param string $input
     *
     * @return array
     */
    public function getAllLeft(string $input): array;

    /**
     * Retrieves all translations from the right to left.
     *
     * @param string $input
     *
     * @return array
     */
    public function getAllRight(string $input): array;
}
