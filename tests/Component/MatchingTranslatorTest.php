<?php

/**
 * Copyright (C) GrizzIT, Inc. All rights reserved.
 * See LICENSE for license details.
 */

namespace GrizzIt\Translator\Tests\Component;

use PHPUnit\Framework\TestCase;
use GrizzIt\Translator\Component\MatchingTranslator;
use GrizzIt\Translator\Exception\CouldNotTranslateException;

/**
 * @coversDefaultClass \GrizzIt\Translator\Component\MatchingTranslator
 * @covers \GrizzIt\Translator\Exception\CouldNotTranslateException
 */
class MatchingTranslatorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::getLeft
     * @covers ::getRight
     * @covers ::get
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
        $subject = new MatchingTranslator($defaultLeft, $defaultRight);

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
     * @covers ::get
     *
     * @return void
     */
    public function testGetLeftException(): void
    {
        $subject = new MatchingTranslator();

        $this->expectException(CouldNotTranslateException::class);

        $subject->getLeft('foo');
    }

    /**
     * @covers ::__construct
     * @covers ::register
     * @covers ::getRight
     * @covers ::get
     *
     * @return void
     */
    public function testGetRightException(): void
    {
        $subject = new MatchingTranslator();

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
                ['baz'],
                ['qux'],
                'foo',
                'bar'
            ],
            [
                'foo',
                'bar',
                ['baz'],
                ['qux'],
                'qux',
                'baz'
            ]
        ];
    }
}
