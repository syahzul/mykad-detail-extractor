<?php
/**
 * 	Malaysia Identity Card Detail Extractor 
 *
 * @copyright	Copyright (c) 2012 Syahril Zulkefli. All rights reserved.
 * @author		Syahril Zulkefli a.k.a. syahzul <syahzul@gmail.com>
 * @license		MIT License
 *	
 * Permission is hereby granted, free of charge, to any person obtaining a copy of 
 * this software and associated documentation files (the "Software"), to deal in the 
 * Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the 
 * following conditions:
 *	
 * The above copyright notice and this permission notice shall be included in all copies 
 * or substantial portions of the Software.
 *	
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
 * PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE 
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE 
 * OR OTHER DEALINGS IN THE SOFTWARE.
 */

class MyIC {
	
	private	$state;
	private	$gender;
	private	$dob;
	
	
	/**
	 * Get the detail from IC number 
	 *
	 * @access	public
	 * @param	string	The raw IC number
	 * @param	string	The date format to use
	 * @return 	array	The detail
	 */
	public function get($ic_no, $date_format = 'j F Y')
	{
		if ( ! empty($ic_no))
		{
			// send it to function to split it
			$sections = $this->split($ic_no);
		
			// get the DOB
			$this->get_dob($sections['dob']);
		
			// get the state
			$this->get_state($sections['state']);
		
			// get the gender
			$this->get_gender($sections['code']);
		
			$detail = array(
				'dob'     => date($date_format, $this->dob),
				'state'   => $this->state,
				'gender'  => $this->gender
			);
		
			return $detail;
		}
	}
	
	
	/**
	 * Splitting the code given to the proper sections
	 *
	 * @access	private
	 * @param	string	The IC number
	 * @return 	array	The sections
	 */
	private function split($code = NULL)
	{
		if ( ! empty($code))
		{
			// the output array
			$output = array();
		
			// split the number into 2 sections
			$sect = str_split($code, 6);
		
			// the DOB section
			$output['dob']	= $sect[0];
		
			// now get the state code
			$other = str_split($sect[1], 2);
		
			// assign it to the output
			$output['state'] = $other[0];
		
			// then, from the last array item in $code, get
			// the last item to be use when checking for gender
			$output['code'] = $other[1].$other[2];
		
			return $output;
		}
	}
	
	
	/**
	 * Get state based on the 2 digits code
	 *
	 * @access	private
	 * @param	integer	The 2 digits state code
	 * @return 	string	The state name
	 */
	private function get_state($code = NULL)
	{
		if ( ! empty($code))
		{
			switch ($code)
			{
				case '01':
				case '21':
				case '22': 
				case '23':
				case '24':
					$this->state = 'Johor';
					break;

				case '02':
				case '25':
				case '26':
				case '27':
					$this->state = 'Kedah';
					break;

				case '03':
				case '28':
				case '29':
					$this->state = 'Kelantan';
					break;

				case '04':
				case '30':
					$this->state = 'Melaka';
					break;

				case '05':
				case '31':
				case '59':
					$this->state = 'Negeri Sembilan';
					break;

				case '06':
				case '32':
				case '33':
					$this->state = 'Pahang';
					break;

				case '07':
				case '34':
				case '35':
					$this->state = 'Penang';
					break;

				case '08':
				case '36':
				case '37':
				case '38':
				case '39':
					$this->state = 'Perak';
					break;

				case '09':
				case '40':
					$this->state = 'Perlis';
					break;

				case '10':
				case '41':
				case '42':
				case '43':
				case '44':
					$this->state = 'Selangor';
					break;

				case '11':
				case '45':
				case '46':
					$this->state = 'Terengganu';
					break;

				case '12':
				case '47':
				case '48':
				case '49':
					$this->state = 'Sabah';
					break;

				case '13':
				case '50':
				case '51':
				case '52':
				case '53':
					$this->state = 'Sarawak';
					break;

				case '14':
				case '54':
				case '55':
				case '56': 
				case '57':
					$this->state = 'Wilayah Persekutuan Kuala Lumpur';
					break;

				case '15':
				case '58':
					$this->state = 'Wilayah Persekutuan Labuan';
					break;

				case '16':
					$this->state = 'Wilayah Persekutuan Putrajaya';
					break;

				case '82':
				default:
					$this->state = 'Others';
					break;

			}
		}
	}
	
	
	/**
	 * Get gender based on the last 4 digits code
	 *
	 * @access	private
	 * @param	integer	The 4 digits IC number
	 * @return 	string	The gender
	 */
	private function get_gender($code = NULL)
	{
		if ( ! empty($code))
		{
			// convert it to integer
			$code = intval($code);
			
			// basically, the last digit will determine the
			// gender; odd for Male and even for Female
			if ($code % 2 === 0)
			{
				$this->gender	= 'Female';
			}
			else
			{
				$this->gender	= 'Male';
			}
		}
	}
	
	
	/**
	 * Get date of birth from the first 6 digits
	 *
	 * @access	private
	 * @param	integer	The first 6 digits IC number
	 * @return 	string	The date of birth
	 */
	private function get_dob($code = NULL)
	{
		if ( ! empty($code))
		{
			// split it into 3 section, 2 digits per section
			$dob = str_split($code, 2);
			
			// get the day
			$day = $dob[2];
			
			// get the month
			$month = $dob[1];
			
			// get the integer value for the year
			$year = intval($dob[0]);
			
			// we need to add 1900 to the year
			if ($year >= 50)
			{
				$year += 1900;
			}
			
			// now convert it into the string and assign it to
			// our variable
			$this->dob = strtotime($year.'-'.$month.'-'.$day);
		}
	}
	
}