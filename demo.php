<!DOCTYPE html>
<html>
	<head>
		<title>Malaysia Identity Card Detail Extractor</title>
	</head>
	<body>
		<h1>Malaysia Identity Card Detail Extractor</h1>
		<p>Malaysians Identity Card number contains some information about the card holder. From 
			the number's, we can get:</p>
		<ol>
			<li>Date of birth</li>
			<li>Place of birth</li>
			<li>Gender</li>
		</ol>
		<p>Try enter your I.C. number and see the result.</p>
		
		<form action="demo.php" method="post">
			<p>
				<label for="number">I.C. number</label>
				<input type="text" maxlength="12" name="number">
			</p>
			<p>
				<button type="submit">Get the detail!</button>
			</p>
		</form>
		
		<?php 
		if ($_POST) 
		{
			require dirname(__FILE__).'/myic.class.php';
			
			$myic = new MyIC;
			
			$detail = $myic->get($_POST['number']);
			
			echo '<pre>';
			print_r($detail);
			echo '</pre>';
		?>
		<p><strong>Date of birth:</strong> <?php echo $detail['dob']; ?></p>
		<p><strong>Place of birth:</strong> <?php echo $detail['state']; ?></p>
		<p><strong>Gender:</strong> <?php echo $detail['gender']; ?></p>
		<?php
		}
		?>
		
		<hr>
		
		<h2>How to Use</h2>
		<p>You can easily use the class in your existing application. Just load the file and create new class instance. Example:</p>
		<pre>require dirname(__FILE__).'/myic.class.php';<br>
// create new instance<br>$myic = new MyIC;<br>
// send the number to the get() method			<br>$detail = $myic-&gt;get($_POST['number']);</pre>
<h3>The output</h3>
<p>The output will be in array:</p>
<pre>Array<br>(
	[dob] =&gt; &lt;the date of birth&gt;<br>	[state] =&gt; &lt;the state&gt;<br>	[gender] =&gt; &lt;the gender&gt;
)</pre>
<h2>License</h2>
<p>MIT license.</p>
<pre>Copyright (C) 2012 Syahril Zulkefli &lt;syahzul@gmail.com&gt;<br>
Permission is hereby granted, free of charge, to any person 
obtaining a copy of this software and associated documentation 
files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, 
merge, publish, distribute, sublicense, and/or sell copies of 
the Software, and to permit persons to whom the Software is furnished 
to do so, subject to the following conditions:<br>
The above copyright notice and this permission notice shall be included 
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING 
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
IN THE SOFTWARE.</pre>
    </body>
</html>