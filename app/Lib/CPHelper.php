<?php

namespace App\Lib;

abstract class CPHelper
{

	protected $endpoint = 'https://www.coinpayments.net/index.php';

	// Can change the style of your payment button
	public function createButton()
	{
		return '<button type="submit" class="btn btn-theme btn-circle ">Confirm Payment</button>';
	}


	public function createProperties($fields)
	{
		$field['cmd']         = '_pay_simple';
		$field['item_name']   = 'Payment';
		$field['custom']	  = '';
		$field['want_shipping'] = '0';


		foreach($field as $key=>$item)
		{
			if(!array_key_exists($key, $fields))
			{
				$fields[$key] = $item;
			}
		}


		return $fields;

	} 


	public function createForm($fields)
	{
		$data = $this->createProperties($fields);

		$text = '<form action="'.$this->endpoint.'" method="post">';

		foreach($data as $name => $value) {
			$text .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		}

		return $text.$this->createButton().'</form>';

	}






}