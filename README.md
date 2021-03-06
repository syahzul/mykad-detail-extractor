Malaysia MyKad Detail Extractor
=======================================

Malaysians Identity Card number contains some information about the card holder. From the number submitted, we can get:

* Date of birth
* Place of birth
* Gender


Usage
----------

You can easily use the class in your existing application. Just load the file and create new class instance. 

<em>Example:</em>

<pre>
require dirname(__FILE__).'/myic.class.php';

// create new instance
$myic = new MyIC;

// send the number to the get() method			
$detail = $myic->get($_POST['number']);
</pre>

If you prefer some other format for the date, you can pass the second parameter to the method. Refer the [PHP documentation] [1] for complete information about date formatting.

<em>Example:</em>

<pre>
require dirname(__FILE__).'/myic.class.php';

// create new instance
$myic = new MyIC;

// set the date format for the output. 
$format = 'Y-m-d';

// send the number to the get() method			
$detail = $myic->get($_POST['number'], $format);
</pre>

[1]: http://php.net/manual/en/function.date.php [PHP documentation]


Output
------

The output will be in array format.

<pre>
Array
(
	[dob]    => the date of birth
	[state]  => the state
	[gender] => the gender
)
</pre>


License
-------

MIT license.

<pre>
Copyright (C) 2012 Syahril Zulkefli <syahzul@gmail.com>

Permission is hereby granted, free of charge, to any person 
obtaining a copy of this software and associated documentation 
files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, 
merge, publish, distribute, sublicense, and/or sell copies of 
the Software, and to permit persons to whom the Software is furnished 
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included 
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING 
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
IN THE SOFTWARE.
</pre>