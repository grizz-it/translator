[![Build Status](https://travis-ci.com/grizz-it/translator.svg?branch=master)](https://travis-ci.com/grizz-it/translator)

# GrizzIT Translator

This package contains an implementation to simplify translations between strings and arrays.

## Installation

To install the package run the following command:

```
composer require grizz-it/translator
```

## Usage

The package contains two implementations for translations.

### [Translator](src/Component/Translator.php)

The Translator is a simple string to string translator.
It takes a left argument to translate to a right and vice-versa.
These translations are possible by invoking the correct method,
either `getLeft` or `getRight`. When invoking `getLeft` it will
translate from the left arguments to the right.

Translations can be registered with the `register` method.

Default values can be provided to the constructor.
If these are null, an exception will be thrown when an untranslatable string is detected.

### [ArrayTranslator](src/Component/ArrayTranslator.php)

The ArrayTranslator works similar to the string translator.
However the array translator can translate from and to multiple outcomes.

The array translator will still retrieve one value (the first match) when calling either `getLeft` or `getRight`.
However when invoking `getAllLeft` or `getAllRight`, all outcomes of the opposite side will be returned.

Registration is the only other key difference, every translation
left and right needs to be registered as an array.
Even if either one only has one option.

### [MatchingTranslator](src/Component/MatchingTranslator.php) & [MatchingArrayTranslator](src/Component/MatchingArrayTranslator.php)

The MatchingTranslator and MatchingArrayTranslator are similar to the
aforementioned translators. However these translator are slower, because
they check each individual key during a comparison supporting the Unix filename
pattern.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## MIT License

Copyright (c) GrizzIT

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
