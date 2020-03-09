<?php
/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Component;

use GrizzIt\Translator\Common\TranslatorInterface;

class Translator implements TranslatorInterface
{
    /**
     * Contains all possible left to right translations.
     *
     * @var string[]
     */
    private $translationsLeft = [];

    /**
     * Contains all possible right to left translations.
     *
     * @var string[]
     */
    private $translationsRight = [];

    /**
     * Contains the default value for left.
     *
     * @var string|null
     */
    private $defaultLeft;

    /**
     * Contains the default value for right.
     *
     * @var string|null
     */
    private $defaultRight;

    /**
     * Constructor.
     *
     * @param string $defaultLeft
     * @param string $defaultRight
     */
    public function __construct(
        string $defaultLeft = null,
        string $defaultRight = null
    ) {
        $this->defaultLeft = $defaultLeft;
        $this->defaultRight = $defaultRight;
    }

    /**
     * Registers a translation.
     *
     * @param string $left
     * @param string $right
     *
     * @return void
     */
    public function register(string $left, string $right): void
    {
        $this->translationsLeft[$left] = $right;
        $this->translationsRight[$right] = $left;
    }

    /**
     * Translates left to right.
     *
     * @param string $input
     *
     * @return string
     *
     * @throws CouldNotTranslateException When the translation can not be resolved.
     */
    public function getLeft(string $input): string
    {
        $output = $this->get(
            $input,
            $this->translationsLeft,
            $this->defaultRight
        );

        if (is_null($output)) {
            throw new CouldNotTranslateException($input);
        }

        return $output;
    }

    /**
     * Translates right to left.
     *
     * @param string $input
     *
     * @return string
     *
     * @throws CouldNotTranslateException When the translation can not be resolved.
     */
    public function getRight(string $input): string
    {
        $output = $this->get(
            $input,
            $this->translationsRight,
            $this->defaultLeft
        );

        if (is_null($output)) {
            throw new CouldNotTranslateException($input);
        }

        return $output;
    }

    /**
     * Internal search for the first match.
     *
     * @param string $input
     * @param array $seek
     * @param string|null $default
     *
     * @return string|null
     */
    private function get(string $input, array $seek, ?string $default): ?string
    {
        if (array_key_exists($input, $seek)) {
            return $seek[$input];
        }

        return $default;
    }
}
