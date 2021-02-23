<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Component;

use GrizzIt\Translator\Common\ArrayTranslatorInterface;
use GrizzIt\Translator\Exception\CouldNotTranslateException;

class MatchingArrayTranslator implements ArrayTranslatorInterface
{
    /**
     * Contains all possible left to right translations.
     *
     * @var string[]
     */
    private array $translationsLeft = [];

    /**
     * Contains all possible right to left translations.
     *
     * @var string[]
     */
    private array $translationsRight = [];

    /**
     * Contains the default value for left.
     *
     * @var string|null
     */
    private ?string $defaultLeft;

    /**
     * Contains the default value for right.
     *
     * @var string|null
     */
    private ?string $defaultRight;

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
     * Registers an option for translation.
     *
     * @param string[] $left
     * @param string[] $right
     *
     * @return void
     */
    public function register(array $left, array $right): void
    {
        [$left, $right] = [array_values($left), array_values($right)];
        $this->translationsLeft = array_merge(
            $this->translationsLeft,
            array_fill_keys($right, $left)
        );

        $this->translationsRight = array_merge(
            $this->translationsRight,
            array_fill_keys($left, $right)
        );
    }

    /**
     * Retrieves the first match of the left to right translation.
     *
     * @param string $input
     *
     * @return string
     */
    public function getLeft(string $input): string
    {
        return $this->getAllLeft($input)[0];
    }

    /**
     * Retrieves all translations from the left to right.
     *
     * @param string $input
     *
     * @return array
     *
     * @throws CouldNotTranslateException When the translation can not be resolved.
     */
    public function getAllLeft(string $input): array
    {
        $output = $this->getAll(
            $input,
            $this->translationsLeft,
            [$this->defaultRight]
        );

        if (is_null($output[0])) {
            throw new CouldNotTranslateException($input);
        }

        return $output;
    }

    /**
     * Retrieves the first match of the right to left translation.
     *
     * @param string $input
     *
     * @return string
     */
    public function getRight(string $input): string
    {
        return $this->getAllRight($input)[0];
    }

    /**
     * Retrieves all translations from the right to left.
     *
     * @param string $input
     *
     * @return array
     *
     * @throws CouldNotTranslateException When the translation can not be resolved.
     */
    public function getAllRight(string $input): array
    {
        $output = $this->getAll(
            $input,
            $this->translationsRight,
            [$this->defaultLeft]
        );

        if (is_null($output[0])) {
            throw new CouldNotTranslateException($input);
        }

        return $output;
    }

    /**
     * Internal search for the first match.
     *
     * @param string $input
     * @param array $seek
     * @param array|null $default
     *
     * @return array|null
     */
    private function getAll(string $input, array $seek, ?array $default): ?array
    {
        foreach ($seek as $option => $value) {
            if (fnmatch($input, $option)) {
                return $value;
            }
        }

        return $default;
    }
}
