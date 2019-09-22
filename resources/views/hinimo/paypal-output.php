<?php
array(8) { 
	["create_time"]=> string(20) "2019-08-31T16:26:23Z" 
	["update_time"]=> string(20) "2019-08-31T16:26:23Z" 
	["id"]=> string(17) "2S5580575M308981H" 
	["intent"]=> string(7) "CAPTURE" 
	["status"]=> string(9) "COMPLETED" 
	["payer"]=> array(4) { 
		["email_address"]=> string(24) "fparan08-buyer@gmail.com" ["payer_id"]=> string(13) "FR4JNWWZMPF74" 
		["address"]=> array(1) { 
			["country_code"]=> string(2) "US" 
		} 
		["name"]=> array(2) { 
			["given_name"]=> string(4) "test" ["surname"]=> string(5) "buyer" 
		} 
	} 
	["purchase_units"]=> array(1) { 
		[0]=> array(5) { 
			["reference_id"]=> string(7) "default" 
			["amount"]=> array(2) { 
				["value"]=> string(6) "126.00" 
				["currency_code"]=> string(3) "PHP" 
			} 
			["payee"]=> array(2) { 
				["email_address"]=> string(30) "fparan08-facilitator@gmail.com" 
				["merchant_id"]=> string(13) "UK87TY6DJGXBN" 
			} 
			["shipping"]=> array(2) { 
				["name"]=> array(1) { 
					["full_name"]=> string(10) "test buyer" 
				} 
				["address"]=> array(5) { 
					["address_line_1"]=> string(9) "1 Main St" 
					["admin_area_2"]=> string(8) "San Jose" 
					["admin_area_1"]=> string(2) "CA" 
					["postal_code"]=> string(5) "95131" 
					["country_code"]=> string(2) "US" 
				} 
			}
			["payments"]=> array(1) { 
				["captures"]=> array(1) {
					[0]=> array(8) { 
						["status"]=> string(9) "COMPLETED" 
						["id"]=> string(17) "1SW55561DS770042P" 
						["final_capture"]=> bool(true) 
						["create_time"]=> string(20) "2019-08-31T16:26:23Z" 
						["update_time"]=> string(20) "2019-08-31T16:26:23Z" 
						["amount"]=> array(2) { 
							["value"]=> string(6) "126.00" 
							["currency_code"]=> string(3) "PHP" 
						} 
						["seller_protection"]=> array(2) { 
							["status"]=> string(8) "ELIGIBLE" 
							["dispute_categories"]=> array(2) { 
								[0]=> string(17) "ITEM_NOT_RECEIVED" 
								[1]=> string(24) "UNAUTHORIZED_TRANSACTION" 
							} 
						} 
						["links"]=> array(3) { 
							[0]=> array(4) { 
								["href"]=> string(69) "https://api.sandbox.paypal.com/v2/payments/captures/1SW55561DS770042P" 
								["rel"]=> string(4) "self" 
								["method"]=> string(3) "GET" 
								["title"]=> string(3) "GET" 
							} 
							[1]=> array(4) { 
								["href"]=> string(76) "https://api.sandbox.paypal.com/v2/payments/captures/1SW55561DS770042P/refund" 
								["rel"]=> string(6) "refund" 
								["method"]=> string(4) "POST" 
								["title"]=> string(4) "POST" 
							} 
							[2]=> array(4) { 
								["href"]=> string(67) "https://api.sandbox.paypal.com/v2/checkout/orders/2S5580575M308981H" 
								["rel"]=> string(2) "up" 
								["method"]=> string(3) "GET" 
								["title"]=> string(3) "GET" 
							} 
						}
					}
				} 
			} 
		} 
	} 
	["links"]=> array(1) { 
		[0]=> array(4) { 
			["href"]=> string(67) "https://api.sandbox.paypal.com/v2/checkout/orders/2S5580575M308981H" 
			["rel"]=> string(4) "self" 
			["method"]=> string(3) "GET" 
			["title"]=> string(3) "GET" 
		} 
	} 
} 



{"sender_batch_header":
	{
		"sender_batch_id":"Payouts_2019_0907032219",
		"email_subject":"You have a payout!",
		"email_message":"You have received a payout! Thanks for using our service!"
	},
	"items":[
		{
			"recipient_type":"EMAIL",
			"amount":
				{
					"value":"192",
					"currency":"PHP"
				},
				"note":"Thanks for your patronage!",
				"sender_item_id":69,
				"receiver":"fparan08-seller@gmail.com"
		}
	]	
}