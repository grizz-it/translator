<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Common;

interface TranslatorInterface
{
    /**
     * Translates left to right.
     *
     * @param string $input
     *
     * @return string
     */
    public function getLeft(string $input): string;

    /**
     * Translates right to left.
     *
     * @param string $input
     *
     * @return string
     */
    public function getRight(string $input): string;
}
