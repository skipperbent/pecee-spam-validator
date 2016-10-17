# Pecee Spam Validator class

Small lightweight class for providing an extremely simple layer of spam-security using moinmo.in's list of blacklisted spam words.

**Note:** this class will not prevent spam 100% and should only be used to add some additional security when validating the contents of your input-fields on your webste.

## Installation

Install this module by running the following composer command:

```composer require pecee/spam-validator```

## Usage

```php
$comment = $_POST['comment'];
$service = new \Pecee\Service\SpamChecker();

if($service->isSpam($comment)) {
    // Comment contains spam
} else {
    // Continue...
}
```

If no path to a spam-list is defined, the class will try to fetch the latest version from http://master.moinmo.in/BadContent?action=raw.

Please store the list locally to avoid calling moinmo.in on each request.

## Methods

#### setPathToSpamList($path)

Set path to local spam-list.

**Example:**

```php
$service = new \Pecee\Service\SpamChecker();
$this->service->setPathToSpamList('/path/to/spamlist.txt');
```

#### setList($list)

Set the contents of the spam-list yourself.

#### setText($text)

Text you want to validate. We would recomment using the property on the `isSpam` method instead.

#### getText()

Returns validated text.

#### downloadList()

Refetch the list from the external source.

## Credits

moinmo's awesome job at creating a dictionary of spam-words.

## The MIT License (MIT)

Copyright (c) 2016 Simon Sessingø / pecee framework

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

