USE IPN
note
	- PayPal sends IPN messages for every type of transaction or transaction status update (including payment and subscription notifications), and each notification type contains a unique set of fields. You need to configure your listener to handle the fields for every type of IPN message you might receive, depending on the types of PayPal transactions you support
	- If your server fails to respond with a successful HTTP response, PayPal will resend this IPN either until a success is received or up to 16 times
	- your checkout flow should not depend upon receiving an IPN message to complete

sample message fields
	mc_gross=19.95 
	protection_eligibility=Eligible 
	address_status=confirmed 
	payer_id=LPLWNMTBWMFAY 
	tax=0.00 
	address_street=1+Main+St 
	payment_date=20%3A12%3A59+Jan+13%2C+2009+PST 
	payment_status=Completed 
	charset=windows-1252 
	address_zip=95131 
	first_name=Test 
	mc_fee=0.88 
	address_country_code=US 
	address_name=Test+User 
	notify_version=2.6 
	custom= 
	payer_status=verified 
	address_country=United+States 
	address_city=San+Jose 
	quantity=1 
	verify_sign=AtkOfCXbDm2hu0ZELryHFjY-Vb7PAUvS6nMXgysbElEn9v-1XcmSoGtf 
	payer_email=gpmac_1231902590_per%40paypal.com 
	txn_id=61E67681CH3238416 								// Keep this ID to avoid processing the transaction twice
	payment_type=instant 
	last_name=User 
	address_state=CA 
	receiver_email=gpmac_1231902686_biz%40paypal.com 
	payment_fee=0.88 
	receiver_id=S8XGHLYDW9T3S 
	txn_type=express_checkout 
	item_name= 
	mc_currency=USD 
	item_number= 
	residence_country=US 
	test_ipn=1 												// testing with sandbox
	handling_amount=0.00 
	transaction_subject= 
	payment_gross=19.95 
	shipping=0.00

handler script
	- After receiving an IPN message from PayPal, you must respond to PayPal with a POST message that is an exact copy of the received message but with "cmd=_notify-validate" added to the end of the message
	- When PayPal receives your POST message, it sends a message back to your listener to indicate the validity of the initial notification. PayPal's message has an HTTP status code of 200 and a body that contains either VERIFIED or INVALID
	- Take the appropriate action(s) based on the notification received
		1. Use the Transaction ID value to ensure you haven't already processed the notification
		2. Confirm the status of the transaction, and take proper action depending on value. For example, payment response options include Completed, Pending, and Denied. Don't send inventory unless the transaction has completed!
		3. Validate the e-mail address of the receiver
		4. Verify the item description and transaction costs with those listed on your website and catalog
		5. Use the values of txn_type or reason_code of a VERIFIED notification to determine your processing actions

