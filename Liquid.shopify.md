# Ref

# Liquid Addition

## Filters

array
    join: 'by'
    first, .first
    last, .last
    index([])
    map: 'array_ele'
    size
    sort
HTML
    img_tag: ['alt text', 'cssClass1 cssClass2 ...']
    script_tag
    stylesheet_tag
math
    ceil
    divided_by:
    floor
    minus:
    plus:
    round:
    times:
    modulo:
money
    money
    money_with_currency
    money_without_trailing_zeros
    money_without_currency
string
    append: 'tail'
    camelcase
    capitalize
    downcase
    escape
    handle/handleize
    md5
    newline_to_br
    pluralize: 'display if singular', 'display if plural'
    prepend: 'leading'
    remove: 'to remove'
    remove_first: 'to remove'
    replace: 'find', 'replace with'
    replace_first: 'find', 'replace with'
    slice: fromIndex, length
    split: 'by'
    strip
    lstrip
    rstrip
    strip_html
    strip_newlines
    truncate: length
    truncatewords: length
    uniq
    upcase
    url_escape
    url_param_escape
URL
    asset_url
    file_url
    customer_login_link
    global_asset_url
    img_url: 'size'
        available size: pico icon thumb small compact medium large grande original 1024x1024 2048x2048 master
    link_to: 'href', 'title'
    link_to_vendor:
    link_to_type
    link_to_tag: 'tag'
    link_to_add_tag: 'tag'
    link_to_remove_tag
    payment_type_img_url
    product_img_url
    collection_img_url
    shopify_asset_url
    url_for_type
    url_for_vendor
    within
other
    date: 'format'
        available format: %a %A %b %B %c %d %-d %D %e %F %H %I %j %k %m %M %p %r %R %T %U %W %w %x %X %Y %Z
    default: 'default value if variable has no value'
    default_errors
    default_pagination
    highlight: search.terms
    highlight_active_tag
    json
    weight_with_unit

## Objects / Variables

address(must specify shipping_address or billing_address, like billing_address.name)
    .name
    .first_name
    .last_name
    .address1
    .address2
    .street
    .company
    .city
    .province
    .province_code
    .zip
    .country
    .country_code
    .phone
article
    .author
    .comments
    .comments_count
    .comments_enabled?
    .comment_post_url
    .content
    .created_at
    .excerpt
    .excerpt_or_content
    .id
    .moderated?
    .published_at
    .tags
    .title
    .url
    .user.account_owner
    .user.bio
    .user.email
    .user.first_name
    .user.last_name
    .user.homepage
blog
    .all_tags
    .articles
    .articles_count
    .comments_enabled?
    .handle
    .id
    .moderated?
    .next_article
    .previous_article
    .tags
    .title
    .url
cart
    .attributes
    .item_count
    .items
    .note
    .total_price
    .total_weight
checkout
    .applied_gift_cards
    .attributes
    .billing_address
    .buyer_accepts_marketing
    .discounts
    .discounts_amount
    .discounts_savings
    .email
    .gift_cards_amount
    .id
    .line_items
    .name
    .note
    .order
    .order_id
    .order_name
    .order_number
    .requires_shipping
    .shipping_address
    .shipping_method
    .shipping_methods
    .shipping_price
    .subtotal_price
    .tax_lines
    .tax_price
    .total_price
    .transactions
collection
    .all_types
    .all_vendors
    .current_type
    .current_vendor
    .default_sort_by
    .description
    .handle
    .id
    .image
    .image.src
    .next_product
    .previous_product
    .products
    .products_count
    .template_suffix
    .title
    .tags
    .url
comment
    .id
    .author
    .email
    .content
    .status
    .url
country_option_tags(creates an <option> tag for each country, must be wrapped in <select>)
current_page(the number of the page you are on when browsing through paginated content)
current_tag(to filter collection or blog that contain a specific tag)
customer_address
    .first_name
    .last_name
    .address1
    .address2
    .street
    .company
    .city
    .province
    .province_code
    .zip
    .country
    .country_code
    .phone
    .id
customer
    .accepts_marketing
    .addresses
    .addresses_count
    .default_address
    .email
    .first_name
    .has_account
    .id
    .last_name
    .last_order
    .name
    .orders
    .orders_count
    .tags
    .total_spent
discount
    .id
    .code
    .amount
    .savings
    .type
forloop
    .first
    .index
    .index0
    .last
    .rindex
    .rindex0
    .length
form
    .author
    .body
    .email
    .errors
    .posted_successfully?
fulfillment
    .tracking_company
    .tracking_number
    .tracking_url
gift_card
    .balance
    .code
    .currency
    .customer
    .enabled
    .expired
    .expires_on
    .initial_value
    .properties
    .url
image
    .alt
    .attached_to_variant?
    .id
    .product_id
    .position
    .src
    .variants
line_item
    .id
    .image
    .product
    .variant
    .title
    .price
    .line_price
    .quantity
    .grams
    .properties
    .sku
    .type
    .vendor
    .requires_shipping
    .taxable
    .url
    .variant_id
    .product_id
    .fulfillment
link(must be invoked inside a linklist)
    .active
    .object
    .title
    .type
    .url
linklist
    .handle
    .id
    .links
    .title
metafields(store additional information for products, collections, orders, blogs, pages and your shop)
order
    .billing_address
    .cancelled
    .cancelled_at
    .cancel_reason
    .cancel_reason_label
    .created_at
    .customer
    .customer_url
    .discounts
    .email
    .financial_status
    .financial_status_label
    .fulfillment_status
    .fulfillment_status_label
    .line_items
    .location
    .name
    .note
    .order_number
    .shipping_address
    .shipping_methods
    .shipping_price
    .subtotal_price
    .tax_lines
    .tax_price
    .total_price
    .transactions
page_description(the description of a Product, Page, Collection, or Blog Article)
page_title(title of a Product, Page, or Blog Article)
page
    .author
    .content
    .handle
    .id
    .published_at
    .template_suffix
    .title
    .url
paginate
    .current_page
    .current_offset
    .items
    .parts
    .next
    .previous
    .page_size
    .pages
part(array represents a link in the pagination's navigation)
    .is_link
    .title
    .url
product
    .available
    .collections
    .compare_at_price_max
    .compare_at_price_min
    .compare_at_price_varies
    .content
    .description
    .featured_image
    .first_available_variant
    .handle
    .id
    .images
    .options
    .price
    .price_max
    .price_min
    .price_varies
    .selected_variant
    .selected_or_first_available_variant
    .tags
    .template_suffix
    .title
    .type
    .url
    .variants
    .vendor
search
    .performed
    .results
    .results_count
    .terms
shipping_method
    .handle
    .price
    .title
shop
    .address
    .collections_count
    .currency
    .description
    .domain
    .email
    .enabled_payment_types
    .metafields
    .money_format
    .money_with_currency_format
    .name
    .password_message
    .permanent_domain
    .products_count
    .types
    .url
    .vendors
    .locale
tablerow
    .index
    .index0
    .rindex
    .rindex0
    .first
    .last
    .col
    .col0
    .col_first
    .col_last
tax_line
    .title
    .price
    .rate
    .rate_percentage
template(the name of the template used to render the current page)
theme(information about published themes in a shop. You can also use themes to iterate through both themes)
    .id
    .role
    .name
transaction
    .id
    .amount
    .name
    .status
    .status_label
    .created_at
    .receipt
    .kind
    .gateway
    .payment_details
variant
    .available
    .barcode
    .compare_at_price
    .id
    .image
    .inventory_management
    .inventory_policy
    .inventory_quantity
    .option1
    .option2
    .option3
    .price
    .requires_shipping
    .selected
    .sku
    .taxable
    .title
    .url
    .weight
    .weight_unit
    .weight_in_unit