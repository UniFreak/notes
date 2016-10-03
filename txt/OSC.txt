====================== Directory =======================
ADMIN/
	BACKUPS/
	EXT/
		MODULES/
			PAYMENT/
				MONEYBOOKERS/
					activation.php
				SOFORTUEBERWEISUNG/
					autoinstaller.gif
					install.php
	IMAGES/
		GRAPHS/
		ICONS/
	INCLUDES/
		BOXES/
			catelog.php
			configuration.php
			customers.php
			localization.php
			modules.php
			modules_content.php
			orders.php
			reports.php
			taxes.php
			tools.php
			tools_database_tables.php
			tools_security_checks.php
		CLASSES/
			action_recorder.php
			box.php
			cfg_modules.php
			currencies.php
			email.php
			language.php
			logger.php
			message_stack.php
			mime.php
			object_info.php
			order.php
			passwordhash.php
			payment_module_info.php
			phplot.php
			rss.php
			shopping_cart.php
			split_page_results.php
			table_block.php
			upload.php
		FUNCTIONS/
			compatibility.php
			database.php
			general.php
			html_graphs.php
			html_output.php
			languages.php
			localization.php
			password_funcs.php
			sessions.php
			validations.php
		GRAPHS/
			banner_daily.php
			banner_infobox.php
			banner_monthly.php
			banner_yearly.php
		JAVASCRIPT/
		LANGUAGES/
			ENGLISH/
				IMAGES/
					BUTTONS/
				MODULES/
					BOXES/
						box module language files...
					CFG_MODULES/
						cfg module language files...
					DASHBOARD/
						dashboard module language files...
					NEWSLETTERS/
						newsletters module language files...
					SECURITY_CHECK/
						security_check module language files...
					misc files' language files...
			english.php
		LOCAL/
			local configuration(which override application_top.php setting) goes
			here
		MODULES/
			CFG_MODULES/
				cfg module files goes here...
			DASHBOARD/
				dashboard module files goes here...
			INDEX/
				index module files goes here...
			NEWSLETTERS/
				newsletters module files goes here...
			SECURITY_CHECK/
				security_check module files goes here...
		stylesheets.css
		general.js

		application_bottom.php
		application_top.php
		column_left.php
		configure.php
		database_tables.php
		filenames.php
		footer.php
		header.php
		template_bottom.php
		template_top.php
	categories.php
	manufactures.php
	products_attributes.php
	products_expected.php
	reviews.php
	specials.php

	action_recorder.php
	banner_manager.php
	cache.php
	backup.php
	databse_tables.php
	define_language.php
	newsletters.php
	security_check.php
	sec_dir_permissions.php
	mail.php
	server_info.php
	version_check.php
	whos_online.php
	
	administrators.php
	store_logo.php
	configuration.php
		// using queryString gID(group ID)&cID(config ID) to set varies 
		// configurations, include:
		// 		Cache/CustomerDetails/Download/E-mailOptions/GZip
		// 		/Compression/Images/Logging/MaximumValues/MinimumValues
		//		/MyStore/ProductListing/Sessions/Shipping&Packaging/Stock
	
	customers.php

	currencies.php
	languages.php
	orders_status.php
	
	countries.php
	tax_classes.php
	tax_rates.php
	geo_zones.php
	zones.php
	
	modules_content.php
	modules.php
		// using queryStirng set to set varies module's configuration, includes:
		//		ActionRecorder/Boxes/Dashboard/HeaderTags/OrderTotal/Payment
		//		Shipping/SocialBookmarks

	orders.php

	banner_statistics.php
	index.php
	invoice.php
	login.php
	packingslip.php
	popup_image.php

	stats_custoemrs.php				// customer's order report
	stats_products_purchased.php	// products purchased report
	stats_products_viewed.php		// products viewed report
DOWNLOAD/
EXT/
	960GS/
	COLORBOX/
	FLOT/
	JQUERY/
	MODULES/
	PHOTOSET-GRID/
IMAGES/
INCLUDES/
	BOXES/
	CLASSES/
		action_recorder.php
		boxes.php
		beradcrumb.php
		cc_validation.php
		currencies.php
		email.php
		http_client.php
		language.php
		message_stack.php
		mime.php
		navigation_history.php
		order.php
		order_total.php
		osc_template.php
		passwordhash.php
		payment.php
		shipping.php
		shopping_cart.php
		splite_page_results.php
	FUNCTIONS/
	LANGUAGES/
	LOCAL/
	MODULES/
	WORK/
	spiders.txt
	general.js
	application_bottom.php
	application_top.php
	configure.php
	counter.php
	database_tables.php
	filenames.php
	footer.php
	form_check.js.php
	header.php
	template_bottom.php
	template_top.php
	version.php
stylesheet.css

account.php
login.php
account_edit.php
logoff.php
password_forgotten.php
password_reset.php
account_history.php					// history orders
account_history_info.php			// history orders info
account_newsletters.php
account_notifications.php
account_password.php
address_book.php					
address_book_process.php			// new/edit address book entry

advanced_search.php
advanced_search_result.php

shopping_cart.php
checkout_shipping.php				// checkout step 1
checkout_shipping_address.php		// checkout step 2
checkout_payment.php				// checkout step 3
checkout_payment_address.php		// checkout step 4
checkout_confirmation.php			// checkout step 5
checkout_process.php				// handle backend
checkout_success.php				// success!
cookie_usage.php
create_account.php
create_account_success.php

index.php
reviews.php
specials.php						// special products
product_info.php
product_reviews.php
product_reviews_info.php
product_reviews_write.php
products_new.php					// new products

conditions.php
contact_us.php
privacy.php
shipping.php
ssl_check.php
redirect.php
tell_a_friend.php
info_shopping_cart.php				// help info on shopping cart
popup_search_help.php				// help info on using search

?download.php
?opensearch.php
?popup_image.php

=============== TABLES ===============

------------------------------- 工具 ------------------------------
action_recorder 				// 登录记录
	id							
	module
	user_id
	user_name
	identifier					// 登录主机 ip
	success
	date_added

counter			// 网站访问总量(按页面计)
	startdate
	counter
counter_history?
	month
	counter

sessions				// SESSION 数据
	sesskey
	expiry
	value

whos_online			// 用户在线信息
	customer_id
	full_name
	sesison_id
	ip_address
	time_entry?
	time_last_click?
	last_page_url?

------------------------------- 周边 ------------------------------
countries
	countries_id
	countries_name
	countries_iso_code_2
	countries_iso_code_3
	address_format_id

currencies
	currencies_id
	title
	code
	symbol_left
	symbol_right
	decimal_point
	thousands_point
	decimal_places?
	value?
	last_updated?

zones
	zone_id
	zone_country_id
	zone_code
	zone_name
geo_zones?
	geo_zone_id
	geo_zone_name
	geo_zone_description
	last_modified
	date_added
zones_to_geo_zones?
	association_id
	zone_country_id
	zoned_id
	geo_zone_id?
	last_modified
	date_added

languages
	languages_id
	name
	code
	image?
	directory
	sort_order

tax_class?
	tax_class_id
	tax_class_title
	tax_class_description
	last_modified
	date_added
tax_rates?
	tax_rates_id
	tax_zone_id
	tax_class_id
	tax_priority
	tax_rate?
	tax_description
	last_modified
	date_added


-------------------------------- 核心 ------------------------------
customers							// 用户
	customers_id
	customeres_gender
	customers_firstname
	customers_lastname
	customers_dob				// date_of_birth
	customers_email_address
	customers_default_address
	customers_telephone
	customers_fax
	customers_password
	customers_newsletter			// 是否接收 newsletter
customers_info
	customers_info_id
	customers_info_date_of_logon
	customers_info_number_of_logons
	customers_info_date_account_created
	customers_info_date_account_last_modified
	global_product_nofifications	// 是否全局商品订阅, 这一项和单项商品订阅互斥, 见 products_notification
	password_reset_key?
	password_reset_date

customers_basket				
	customers_basket_id
	customers_id
	products_id
	customers_basket_quantity
	final_price
	customers_basket_date_added
customers_basket_attributes		// 购物车内商品的额外属性信息, 参见 products_attribute
	customers_basket_attributes_id
	customers_id
	products_id
	products_options_id
	products_options_value_id

manufacturers
	manufacturers_id
	manufacturers_name
	namufacturers_image
	date_added
	last_modifed
manufacturers_info
	manufacturers_id
	language_id
	manufacturers_url
	url_clicked
	date_last_click

orders @?: why repeat customers,delivery,billing table?
	orders_id
	customers_id
	customers_name
	customers_company
	customers_street_address
	customers_suburb
	customers_city
	customers_postcode
	customers_state
	customers_country
	customers_telephone
	customers_email_address
	customers_address_format
	delivery_name
	delivery_company
	delivery_street_address
	delivery_suburb
	delivery_city
	delivery_postcode
	delivery_state
	delivery_country
	delivery_address_format_id
	billing_name
	billing_company
	billing_street_address
	billing_suburb
	billing_city
	billing_postcode
	billing_state
	billing_country
	billing_address_format_id
	payment_method
	cc_type?
	cc_owner?
	cc_number?
	cc_expires?
	last_modified
	date_purchased
	orders_status?
	orders_date_finished?
	currency
	currency_value?
orders_products?
	orders_products_id
	orders_id
	products_id
	products_model?
	products_name
	products_price
	final_price					// 最终单价(受不同参数选项的影响)
	products_tax
	products_quantity
orders_products_attributes	// 订单商品属性(类同商品属性)
	order_products_attributes_id
	orders_id
	orders_products_id
	products_options
	products_options_values
	options_values_price
	price_prefix
orders_products_download   	// 订单虚拟商品(类同 products_download)
	orders_products_download_id
	orders_id
	orders_products_id
	orders_products_filename
	download_maxdays
	download_count
orders_status?
	(
		1:Pending
		3:Shipped
		15:Voided
		16:Paid
		17:Payment-Failed
		18:Cancelled
	)
	orders_status_id
	language_id
	orders_status_name
	public_flag
	downloads_flag
orders_status_history
	orders_status_history_id
	orders_id
	orders_status_id
	date_added
	customer_notified
	comments
orders_total					// 订单计费
	orders_total_id
	orders_id
	title
	text
	value
	class
	sort_order

affiliate_sales 	// 通过雇员的销售记录
	affiliate_id(p)				// 雇主 id
	affiliate_date				
	affiliate_browser
	affiliate_ipaddress
	affiliate_orders_id(p)		// orders id
	affiliate_value				// 造成的收益
	affiliate_payment			// 应付的佣金
	affiliate_clickthroughts_id
	affiliate_billing_status	// 0:Pending, 1:Paid
	affiliate_payment_id
	affiliate_percent			// 佣金/收益比
	affiliate_salesman			// 同雇主 id
affiliate_payment	// 给雇员的支付记录
	affiliate_payment_id
	affiliate_id
	affiliate_payment			// 应付佣金
	affiliate_payment_tax		// 税额
	affiliate_payment_total		// 实付佣金
	affiliate_payment_date
	affiliate_payment_last_modified
	affiliate_payment_status?
	affiliate_firstname
	affiliate_lastname
	affiliate_street_address
	affiliate_suburb
	affiliate_postcode
	affiliate_country
	affiliate_company
	affiliate_state
	affiliate_address_format_id
	affiliate_last_modified

products
	products_id
	products_quantity
	products_model
	products_image
	products_price
	products_date_added
	products_last_modified
	products_date_available
	products_weight
	products_status?
	products_tax_class_id?
	manufacturers_id
	products_ordered?			// 订单数量?
	products_in_99?
	lp
products_attributes_download	// 虚拟商品属性
	products_attributes_id
	products_attributes_filename
	products_attributes_maxdays
	products_attributes_maxcount
products_description
	products_id
	language_id
	products_name
	products_description
	products_url
	products_viewed
products_images
	id
	products_id
	image
	htmlcontent?
	sort_order
products_notifications		// 商品订阅
	products_id
	customers_id
	date_added
products_options 			// 定义商品有哪些可用的属性
	products_options_id
	language_id
	products_options_name
products_options_values 	// 定义商品属性可用值
	products_options_values_id
	language_id
	products_options_values_name
products_options_values_to_products_options	
	// 商品属性, 值的对应关系 @?: 感觉功用和 products_attributes 重复了
	products_options_values_to_products_options_id
	products_options_id
	products_options_values_id
products_attributes		
	// 商品参数选项, 比如 1{4}2{3}6 即商品 id 为 1, 选项 id 为 4 的选项值为 2 和 选线 id 为 3 的选项值为 6 的商品
	products_attributes_id			
	products_id				
	options_id						// 选项 id
	options_values_id				// 选项值 id
	options_values_price			// 选项值对应价格
	price_prefix					// 价格前标(+/-)
products_to_categories	// 定义商品和类别的对应关系
	products_id
	categories_id

specials				// 促销商品
	specials_id
	products_id
	specials_new_products_price	// 促销价
	specials_date_added
	specials_last_modified
	expires_date					// 过期日期
	date_status_change?
	status?
	batchid?
	batchtitle?

reviews
	reviews_id
	products_id
	customers_id
	customers_name
	reviews_rating
	date_added
	last_modified
	reviews_status
	reviews_read
reviews_description
	reviews_id
	language_id
	reviews_text

newsletters?
	newsletters_id
	title
	content
	module
	date_added
	date_sent
	status
	locked?

address_book
	address_book_id
	customer_id
	entry_gender
	entry_company
	entry_firstname
	entry_lastname
	entry_street_address
	entry_suburb				// 区/县
	entry_postcode
	entry_city
	entry_state					// 省
	entry_country_id
	entry_zone_id
address_format
	address_format_id
	address_format
	address_summary

administrators
	id
	user_name
	user_password

banners						// 横标, 区块
	banners_id
	banners_title
	banners_image
	banners_group
	banners_html_text
	expires_impressions?
	expires_date
	date_scheduled?
	date_added
	date_status_change
	status
banners_history
	banners_history_id
	banners_id
	banners_shown
	banners_clicked
	banners_history_date

categories
	categories_id
	categories_image
	parent_id
	sort_order?
	date_added
	last_modified
categories_description
	categories_id
	language_id
	categories_name

configuration
	configuration_id
	configuration_title
	configuration_key
	configuration_value
	configuration_description
	configuration_group_id
	sort_order
	last_modified
	date_added
	user_function?
	set_function?
configuration_group
	configuration_group_id
	configuration_group_title
	configuration_group_description
	sort_order
	visible

sec_directory_whitelist?
	id
	directory

====================== Functions =======================
----------------General--------------------
tep_get_category_tree
tep_email_inject_check
tep_exit
tep_redirect
tep_parse_input_field_data
tep_output_string
tep_output_string_protected
tep_sanitize_string
tep_random_select
tep_get_products_name
tep_get_products_special_price
tep_get_products_stock
tep_check_stock
tep_break_string
tep_get_all_get_params
tep_get_countries
tep_get_countries_with_iso_codes
tep_get_path
tep_browser_detect
tep_get_country_name
tep_get_zone_name
tep_get_zone_code
tep_round
tep_get_tax_rate
tep_get_tax_description
tep_add_tax
tep_calculate_tax
tep_count_products_in_category
tep_has_category_subcategories	
tep_get_address_format_id
tep_address_format
tep_address_udformat
tep_row_number_format
tep_get_categories
tep_get_manufactures
tep_get_subcategories
tep_date_long
tep_date_short
tep_parse_search_string
tep_checkdate
tep_create_sort_heading
tep_get_product_path
tep_get_uprid
tep_get_prid
tep_customer_greeting
tep_mail
tep_mail2
tep_has_product_attributes
tep_word_count
tep_count_modules
tep_count_payment_modules
tep_count_shipping_modules
tep_create_random_value
tep_array_to_string
tep_not_null
tep_display_tax_value
tep_currency_exists
tep_string_to_int
tep_parse_category_path
tep_rand
tep_setcookie
tep_get_ip_address
tep_count_customer_orders
tep_count_customer_address_book_entries
tep_convert_linefeeds
tep_get_sources
tep_is_testpeople
tep_test_log
