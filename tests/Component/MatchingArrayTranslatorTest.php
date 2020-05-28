<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Tests\Component;

use PHPUnit\Framework\TestCase;
use GrizzIt\Translator\Component\MatchingArrayTranslator;
use GrizzIt\Translator\Exception\CouldNotTranslateException;

/**
 * @coversDefaultClass \GrizzIt\Translator\Component\MatchingArrayTranslator
 * @covers \GrizzIt\Translator\Exception\CouldNotTranslateException
 */
class MatchingArrayTranslatorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::getLeft
     * @covers ::getAllLeft
     * @covers ::getRight
     * @covers ::getAllRight
     * @covers ::getAll
     *
     * @param string|null $defaultLeft
     * @param string|null $defaultRight
     * @param array $translationsLeft
     * @param array $translationsRight
     * @param string $left
     * @param string $right
     *
     * @return void
     *
     * @dataProvider translationProvider
     */
    public function testGet(
        ?string $defaultLeft,
        ?string $defaultRight,
        array $translationsLeft,
        array $translationsRight,
        string $left,
        string $right
    ): void {
        $subject = new MatchingArrayTranslator($defaultLeft, $defaultRight);

        foreach ($translationsLeft as $key => $value) {
            $subject->register($value, $translationsRight[$key]);
        }

        $this->assertEquals($right, $subject->getLeft($left));
        $this->assertEquals($left, $subject->getRight($right));
    }

    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::getLeft
     * @covers ::getAllLeft
     * @covers ::getAll
     *
     * @return void
     */
    public function testGetLeftException(): void
    {
        $subject = new MatchingArrayTranslator();

        $this->expectException(CouldNotTranslateException::class);

        $subject->getLeft('foo');
    }

    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::getRight
     * @covers ::getAllRight
     * @covers ::getAll
     *
     * @return void
     */
    public function testGetRightException(): void
    {
        $subject = new MatchingArrayTranslator();

        $this->expectException(CouldNotTranslateException::class);

        $subject->getRight('foo');
    }

    /**
     * Provides translations for tests.
     *
     * @return array
     */
    public function translationProvider(): array
    {
        return [
            [
                'foo',
                'bar',
                [['baz']],
                [['qux']],
                'foo',
                'bar'
            ],
            [
                'foo',
                'bar',
                [['baz']],
                [['qux']],
                'qux',
                'baz'
            ]
        ];
    }
}
