# Accessibility Rules

- Be sure to use a <nav> element or, if using a more generic element such as a <div>, add a role="navigation" to every navbar or tab or pill
- Always add label
- Use `role`
- Use `arai-labelledby`
- Use `sr-only`


# BASE CSS

Breakpoint
	xs: < 768px(default)
	sm: < 992px
	md: < 1200px
	lg: > 1200px
Containers
	- neither container is nestable

	.container: for a responsive fixed width container
	.container-fluid: or a full width container, spanning the entire width of your viewport
Grid
	- If more than 12 columns are placed within a single row, each group of extra columns will, as one unit, wrap onto a new line
	- grid can be nested

	.container | .container-fluid
		.row
			.col-*

	.row
	.col-xs-* .col-sm-* .col-md-* .col-lg-*
	.col-xs-offset-* .col-sm-offset-* .col-md-offset-* .col-lg-offset-*
	.col-xs-push-* .col-sm-push-* .col-md-push-* .col-lg-push-*
	.col-xs-pull-* .col-sm-pull-* .col-md-pull-* .col-lg-pull-*

	@grid-columns
	@grid-gutter-width
	@grid-float-breakpoint
Typography
	.h1 .h2 .h3 .h4 .h5 .h6
	.small
	.lead
	.text-left .text-right .text-center .text-justify .text-nowrap
	.text-lowercase .text-uppercase .text-capitalize
	abbr.initialism
	blockquote.blockquote-reverse
	.list-unstyled .list-inline
	.dl-horizontal
	pre.pre-scrollable

	@font-size-base
	@line-height-base
Table
	<container>
		.table-responsive
	table
		.table .table-striped .table-bordered .table-hover .table-condensed
	tr | td | th
		.active .success .warning .danger .info
Form
	- Do not mix form groups directly with input groups. Instead, nest the input group inside of the form group
	- Help text should be explicitly associated with the form control it relates to using the `aria-describedby` attribute


	.form-control
	.form-control-static
	.form-inline .form-horizontal
	.form-group .form-group-lg .from-group-sm
	.input-group .input-group-addon
	.control-label
	.radio .radio-inline
	.checkbox .checkbox-inline
	.has-success .has-warning .has-error
	.has-feedback .form-contrl-feedback
	.input-lg .input-sm
	.help-block
Button
	- While button classes can be used on <a> and <button> elements, only <button> elements are supported within our nav and navbar components
	- If the <a> elements are used to act as buttons – triggering in-page functionality, rather than navigating to another document or section within the current page – they should also be given an appropriate role="button"
	- highly recommend using the <button> element whenever possible

	.btn
	.btn-default .btn-primary .btn-success .btn-info .btn-warning .btn-danger .btn-link
	.btn-lg .btn-sm btn-xs
	.btn-block
	.active .disabled
Images
	.image-responsive
	.image-rounded .image-circle .image-thumbnail
Helper
	- Sometimes helper classes cannot be applied due to the specificity of another selector. In some cases, a sufficient workaround is to wrap your element's content in a wrapper with the class.
	- To align components in navbars with utility classes, use .navbar-left or .navbar-right instead

	.text-muted .text-primary .text-success .text-info .text-warning .text-danger
	.bg-primary .bg-success .bg-info .bg-warning .bg-danger
	.close .caret
	.pull-left .pull-right
	.center-block
	.clearfix
	.show .hidden .invisible
	.sr-only .sr-only-focusable
	.text-hide
Responsive utilities
	.visible-[xs|sm|md|lg]-[block|inline|inline-block]
	.hidden-[xs|sm|md|lg]-[block|inline|inline-block]
	.visible-print-[block|inline|inline-block]
	.hidden-print


# Components

Glyphicons
	- Icon classes cannot be directly combined with other components. They should not be used along with other classes on the same element. Instead, add a nested <span> and apply the icon classes to the <span>
	- Icon classes should only be used on elements that contain no text content and have no child elements

	.glyphicon
	.glyphicon-asterisk .glyphicon-plus .glyphicon-euro
	.glyphicon-eur .glyphicon-minus .glyphicon-cloud
	.glyphicon-envelope .glyphicon-pencil .glyphicon-glass
	.glyphicon-music .glyphicon-search .glyphicon-heart
	.glyphicon-star .glyphicon-star-empty .glyphicon-user
	.glyphicon-film .glyphicon-th-large .glyphicon-th
	.glyphicon-th-list .glyphicon-ok .glyphicon-remove
	.glyphicon-zoom-in .glyphicon-zoom-out .glyphicon-off
	.glyphicon-signal .glyphicon-cog .glyphicon-trash
	.glyphicon-home .glyphicon-file .glyphicon-time
	.glyphicon-road .glyphicon-download-alt .glyphicon-download
	.glyphicon-upload .glyphicon-inbox .glyphicon-play-circle
	.glyphicon-repeat .glyphicon-refresh .glyphicon-list-alt
	.glyphicon-lock .glyphicon-flag .glyphicon-headphones
	.glyphicon-volume-off .glyphicon-volume-down .glyphicon-volume-up
	.glyphicon-qrcode .glyphicon-barcode .glyphicon-tag
	.glyphicon-tags .glyphicon-book .glyphicon-bookmark
	.glyphicon-print .glyphicon-camera .glyphicon-font
	.glyphicon-bold .glyphicon-italic .glyphicon-text-height
	.glyphicon-text-width .glyphicon-align-left .glyphicon-align-center
	.glyphicon-align-right .glyphicon-align-justify .glyphicon-list
	.glyphicon-indent-left .glyphicon-indent-right .glyphicon-facetime-video
	.glyphicon-picture .glyphicon-map-marker .glyphicon-adjust
	.glyphicon-tint	.glyphicon-edit .glyphicon-share
	.glyphicon-check .glyphicon-move .glyphicon-step-backward
	.glyphicon-fast-backward .glyphicon-backward .glyphicon-play
	.glyphicon-pause .glyphicon-stop .glyphicon-forward
	.glyphicon-fast-forward .glyphicon-step-forward .glyphicon-eject
	.glyphicon-chevron-left .glyphicon-chevron-right .glyphicon-plus-sign
	.glyphicon-minus-sign .glyphicon-remove-sign .glyphicon-ok-sign
	.glyphicon-question-sign .glyphicon-info-sign .glyphicon-screenshot
	.glyphicon-remove-circle .glyphicon-ok-circle .glyphicon-ban-circle
	.glyphicon-arrow-left .glyphicon-arrow-right .glyphicon-arrow-up
	.glyphicon-arrow-down .glyphicon-share-alt .glyphicon-resize-full
	.glyphicon-resize-small .glyphicon-exclamation-sign .glyphicon-gift
	.glyphicon-leaf .glyphicon-fire .glyphicon-eye-open
	.glyphicon-eye-close .glyphicon-warning-sign .glyphicon-plane
	.glyphicon-calendar .glyphicon-random .glyphicon-comment
	.glyphicon-magnet .glyphicon-chevron-up .glyphicon-chevron-down
	.glyphicon-retweet .glyphicon-shopping-cart .glyphicon-folder-close
	.glyphicon-folder-open .glyphicon-resize-vertical .glyphicon-resize-horizontal
	.glyphicon-hdd .glyphicon-bullhorn .glyphicon-bell
	.glyphicon-certificate .glyphicon-thumbs-up .glyphicon-thumbs-down
	.glyphicon-hand-right .glyphicon-hand-left .glyphicon-hand-up
	.glyphicon-hand-down .glyphicon-circle-arrow-right .glyphicon-circle-arrow-left
	.glyphicon-circle-arrow-up .glyphicon-circle-arrow-down .glyphicon-globe
	.glyphicon-wrench .glyphicon-tasks .glyphicon-filter
	.glyphicon-briefcase .glyphicon-fullscreen .glyphicon-dashboard
	.glyphicon-paperclip .glyphicon-heart-empty .glyphicon-link
	.glyphicon-phone .glyphicon-pushpin .glyphicon-usd
	.glyphicon-gbp .glyphicon-sort .glyphicon-sort-by-alphabet
	.glyphicon-sort-by-alphabet-alt .glyphicon-sort-by-order .glyphicon-sort-by-order-alt
	.glyphicon-sort-by-attributes .glyphicon-sort-by-attributes-alt .glyphicon-unchecked
	.glyphicon-expand .glyphicon-collapse-down .glyphicon-collapse-up
	.glyphicon-log-in .glyphicon-flash .glyphicon-log-out
	.glyphicon-new-window .glyphicon-record .glyphicon-save
	.glyphicon-open .glyphicon-saved .glyphicon-import
	.glyphicon-export .glyphicon-send .glyphicon-floppy-disk
	.glyphicon-floppy-saved .glyphicon-floppy-remove .glyphicon-floppy-save
	.glyphicon-floppy-open .glyphicon-credit-card .glyphicon-transfer
	.glyphicon-cutlery .glyphicon-header .glyphicon-compressed
	.glyphicon-earphone .glyphicon-phone-alt .glyphicon-tower
	.glyphicon-stats .glyphicon-sd-video .glyphicon-hd-video
	.glyphicon-subtitles .glyphicon-sound-stereo .glyphicon-sound-dolby
	.glyphicon-sound-5-1 .glyphicon-sound-6-1 .glyphicon-sound-7-1
	.glyphicon-copyright-mark .glyphicon-registration-mark .glyphicon-cloud-download
	.glyphicon-cloud-upload .glyphicon-tree-conifer .glyphicon-tree-deciduous
	.glyphicon-cd .glyphicon-save-file .glyphicon-open-file
	.glyphicon-level-up .glyphicon-copy .glyphicon-paste
	.glyphicon-alert .glyphicon-equalizer .glyphicon-king
	.glyphicon-queen .glyphicon-pawn .glyphicon-bishop
	.glyphicon-knight .glyphicon-baby-formula .glyphicon-tent
	.glyphicon-blackboard .glyphicon-bed .glyphicon-apple
	.glyphicon-erase .glyphicon-hourglass .glyphicon-lamp
	.glyphicon-duplicate .glyphicon-piggy-bank .glyphicon-scissors
	.glyphicon-bitcoin .glyphicon-yen .glyphicon-ruble
	.glyphicon-scale .glyphicon-ice-lolly .glyphicon-ice-lolly-tasted
	.glyphicon-education .glyphicon-option-horizontal .glyphicon-option-vertical
	.glyphicon-menu-hamburger .glyphicon-modal-window .glyphicon-oil
	.glyphicon-grain .glyphicon-sunglasses .glyphicon-text-size
	.glyphicon-text-color .glyphicon-text-background .glyphicon-object-align-top
	.glyphicon-object-align-bottom .glyphicon-object-align-horizontal .glyphicon-object-align-left
	.glyphicon-object-align-vertical .glyphicon-object-align-right .glyphicon-triangle-right
	.glyphicon-triangle-left .glyphicon-triangle-bottom .glyphicon-triangle-top
	.glyphicon-console .glyphicon-superscript .glyphicon-subscript
	.glyphicon-menu-left .glyphicon-menu-right .glyphicon-menu-down .glyphicon-menu-up
Dropdown
	.dropdown
		.dropdown-toggle[data-toggle=dropdown]
		ul.dropdown-menu
			li>a.dropdown-header
			li>a.divider

	.dropdown
	.dropup
	.dropdown-toggle
	.dropdown-menu .dropdown-menu-right .dropdown-menu-left
	.dropdown-header .divider .disabled
Button group
	- Place a .btn-group within another .btn-group when you want dropdown menus mixed with a series of buttons

	.btn-toolbar
		.btn-group
			.btn

	.btn-toolbar
	.btn-group .btn-group-vertical
	.btn-group-lg .btn-group-sm .btn-group-xs
	.btn-group-justified
Input group
	- Textual <input>s only
	- Do not mix form groups or grid column classes directly with input groups. Instead, nest the input group inside of the form group or grid-related element
	- You can place any checkbox or radio option within an input group's addon instead of text
	- Buttons in input groups are a bit different and require one extra level of nesting. Instead of .input-group-addon, you'll need to use .input-group-btn to wrap the buttons.

	.input-group
		span.input-group-addon
		input.form-control

	.input-group
	.input-group-lg .input-group-sm
	.input-group-addon .input-group-btn
Navs
	- If you are using navs to provide a navigation bar, be sure to add a role="navigation" to the most logical parent container of the <ul>, or wrap a <nav> element around the whole navigation. Do not add the role to the <ul> itself

	.tabpanel
		.nav.nav-tabs|.nav-pills
			li.active>a[href=#<id>,data-toggle=tab]
			...
		.tab-content
			.tab-pane.active#<id>
			...

	.nav
	.nav-tabs .nav-pills
	.nav-stacked .nav-justified
Navbar
	- The fixed navbar will overlay your other content, unless you add padding to the top or the bottom of the <body>

	.navbar
		.navbar-header
			.navbar-toggle.collapsed[data-toggle=collapse,data-target=<target-id>]
				span.icon-bar*3
			.navbar-brand
		.collapse.navbar-collapse#<target-id>
			.nav.navbar-nav
				.active
				<other nav list>
			.navbar-form

	.nav
	.navbar .navbar-default .navbar-fixed-top .navbar-fixed-bottom .navbar-static-top .navbar-inverse
	.navbar-header .navbar-nav .navbar-form .navbar-btn .navbar-text .navbar-link
	.navbar-toggle .navbar-collapse
	.navbar-left .navbar-right
Breadcrumb
	ol.breadcrumb
		li>a*n

	.breadcrumb
	.active
Pagination
	ul.pagination
		li>a*n

	.pagination
	.pagination-lg .pagination-sm
	.active .disabled
Pager
	nav
		ul.pager
			li.previous>a
			li.next>a

	.pager
	.previous .next
	.disabled
Label
	.label
	.label-default .label-primary .label-success .label-info .label-warning .label-danger
Badge
	.badge
Jumbotron
	- To make the jumbotron full width, and without rounded corners, place it outside all .containers and instead add a .container within

	.jumbotron
Pager header
	.pager-header
Thumbnail
	.thumbnail
		.caption
Alert
	.alert
	.alert-success .alert-info .alert-warning .alert-danger
	.alert-dismissible
	.alert-link
Progress bar
	- Place multiple bars into the same .progress to stack them.

	.progress
		.progress-bar

	.progress
	.progress-bar
	.progress-bar-striped .active
	.progress-bar-success .progress-bar-info progress-bar-warning progress-bar-danger
Media object
	.media-list
		.media
			.media-left
				.media-object
			.media-body
				.media-heading
			.media-right
				.media-object
		...

	.media-list
	.media
	.media-left .media-body .media-right
	.media-middle
	.media-object .media-heading
List group
	.list-group
		.list-group-item
			.list-group-item-heading
			.list-group-item-text
		...

	.list-group
	.list-group-item
	.list-group-item-success .list-group-item-info .list-group-item-warning .list-group-item-danger
	.list-group-item-heading .list-group-item-text
	.active .diabled
Panel
	- Add any non-bordered .table within a panel for a seamless design. If there is a .panel-body, we add an extra border to the top of the table for separation
	- If there is no panel body, the component moves from panel header to table without interruption
	- You can easily include full-width list groups within any panel

	.panel-group
		.panel
			.panel-heading
				h1~h6.panel-title
			.panel-body
			.panel-footer


	.panel
	.panel-default
	.panel-primary .panel-success .panel-warning .panel-danger
Responsive embed
	.embed-responsive
		iframe.embed-responsive-item
Well
	.well
	.well-lg .well-sm

# Javascript

- You can use all Bootstrap plugins purely through the markup API without writing a single line of JavaScript. This is Bootstrap's first-class API and should be your first consideration when using a plugin
- we also provide the ability to disable the data attribute API by unbinding all events on the document namespaced with data-api. This looks like this:
	$(document).off('.data-api')
-  to target a specific plugin, just include the plugin's name as a namespace along with the data-api namespace like this:
	$(document).off('.alert.data-api')
- Don't use data attributes from multiple plugins on the same element. For example, a button cannot both have a tooltip and toggle a modal. To accomplish this, use a wrapping element
- All methods should accept an optional options object, a string which targets a particular method, or nothing (which initiates a plugin with default behavior)
- You can change the default settings for a plugin by modifying the plugin's Constructor.DEFAULTS object
- Bootstrap provides custom events for most plugins' unique actions. Generally, these come in an infinitive and past participle form - where the infinitive (ex. show) is triggered at the start of an event, and its past participle form (ex. shown) is triggered on the completion of an action
- Options can be passed via data attributes or JavaScript. For data attributes, append the option name to `data-`

Transition.js
Modal.js
	- Always try to place a modal's HTML code in a top-level position in your document to avoid other components affecting the modal's appearance and/or functionality
	- Be sure not to open a modal while another is still visible

	Data API Usage:
		<!-- trigger -->
		[data-toggle=modal,data-target=#<modal-id>]
		<!-- modal -->
		.modal#<modal-id>
			.modal-dialog
				.modal-content
					.modal-header
						button.close[data-dismiss=modal]
						.modal-title
					.modal-body
					.modal-footer

		.modal
		.modal-dialog .bs-example-modal-lg .bs-example-modal-sm
		.modal-content
		.modal-header .modal-body .modal-footer
		.modal-title

	JS Usage:
		Method
			.modal(options)
			.modal('toggle')
			.modal('show')
			.modal('hide')
		Options
			backdrop	boolean | static
			keyboard	boolean
			show		boolean
			remote		<url>
		Event
			show.bs.modal
			shown.bs.modal
			hide.bs.modal
			hidden.bs.modal
			loaded.bs.modal
Dropdwon.js
	Data API Usage
		<see components section>
	JS Usage
		- Regardless of whether you call your dropdown via JavaScript or instead use the data-api, data-toggle="dropdown" is always required to be present on the dropdown's trigger element

		Methods
			.dropdown() .dropdown('toggle')
		Options
			<none>
		Events
			- All dropdown events are fired at the .dropdown-menu's parent element
			- All dropdown events have a relatedTarget property, whose value is the toggling anchor element

			show.bs.dropdown
			shown.bs.dropdown
			hide.bs.dropdown
			hidden.bs.dropdown
Scrollspy.js
	- Requires the use of a Bootstrap nav component for proper highlighting of active links
	- Navbar links must have resolvable id targets
	- Target elements that are not :visible according to jQuery will be ignored
	- No matter the implementation method, scrollspy requires the use of position: relative; on the element you're spying on. In most cases this is the <body>

	Data API Usage
		body[data-spy=scroll,data-target=<navbar>]
			<navbar>

	JS Usage
		Mehtods
			.scrollspy({ target: '.navbar-example'})
			.scrollspy('refresh')
		Options
			offset	number
		Events
			activate.bs.scrollby
Tab.js
	Data API Usage
		- To make tabs fade in, add .fade to each .tab-pane. The first tab pane must also have .in to properly fade in initial content

		<see components section>
	JS Usage
		Methods
			.tab('show')
		Options
		Events
			hide.bs.tab
			show.bs.tab
			hidden.bs.tab
			shown.bs.tab
Tooltip.js
*	- The Tooltip and Popover data-apis are opt-in, meaning you must initialize them yourself
	- Tooltips with zero-length titles are never displayed
	- When using tooltips on elements within a .btn-group or an .input-group, you'll have to specify the option container: 'body' (documented below) to avoid unwanted side effects
	- Don't try to show tooltips on hidden elements
	- Tooltips on disabled elements require wrapper elements

	Data API Usage
		[data-toggle=tooltip,data-placement=left | right | top | bottom,title=<tooltip to show>]

	JS Usage
		Methods
			.tooltip(options)
			.tooltip('show')
			.tooltip('hide')
			.tooltip('toggle')
			.tooltip('destory')
		Options
			animation	boolean
			container	string | false
			delay		number | object({"show": <number>, "hide":<number>})
			html		boolean
			placement	string | function
			selector	string
			template	string
			title		string | function
			triger		'hover' | 'focus' | 'click'
			viewport	string | object({ selector: <selector>, padding:<number>})
		Events
			show.bs.tooltip
			shown.bs.tooltip
			hide.bs.tooltip
			hiden.bs.tooltip
Popover.js
*	- The Tooltip and Popover data-apis are opt-in, meaning you must initialize them yourself
	- When using popovers on elements within a .btn-group or an .input-group, you'll have to specify the option container: 'body' (documented below) to avoid unwanted side effects
	- Don't try to show popovers on hidden elements
	- Popovers on disabled elements require wrapper elements

	Data API Usage
		[data-toggle=popover,title=<popover title>,data-content=<popover content>,data-placement=left | top | right | bottom]

	JS Usage
		Methods
			.popover(options)
			.popover('show')
			.popover('hide')
			.popover('toggle')
			.popover('destory')
		Options
			animation	boolean
			container	string | false
			content		string | function
			delay		number | object({ 'show': <number>, 'hide': <number>})
			html		boolean
			placement	'top' | 'bottom' | 'left' | 'right' | function
			selector	string
			template	string
			title		string | function
			trigger		'click' | 'hover' | 'focus' | 'manual'
			viewport	string | object
		Events
			show.bs.popover
			shown.bs.popover
			hide.bs.popover
			hidden.bs.popover
Alert.js
	- When using a .close button, it must be the first child of the .alert-dismissible and no text content may come before it in the markup

	Data API Usage
		.alert
			button.close[data-dismiss=alert]
				span{&times;}
			<alert content>

	JS Usage
		Methods
			.alert()
			.alert('close')
		Events
			close.bs.alert
			closed.bs.alert
Button.js
	Data API Usage
		[data-toggle=buttons,data-<state>-text=<state text>]

	JS Usage
		.button('toggle')
		.button('reset')
		.button(string)		// swaps text to any data defined text state
Collapse.js
	- You can use a link with the href attribute, or a button with the data-target attribute. In both cases, the data-toggle="collapse" is required

	Data API Usage
		a[href=#<targetId>][data-toggle=collapse] | button[data-target=#<targetId>][data-toggle=collapse]
		...
		.collapse#targetId
		...

	JS Usage
		Methods
			.collapse(options)
			.collapse('toggle')
			.collapse('show')
			.collapse('hide')
		Options
			parent	selector
			toggle	boolean
		Events
			show.bs.collapse
			shown.bs.collapse
			hide.bs.collapse
			hidden.bs.collapse
Carousel.js
	- Nested carousels are not supported
	- The .active class needs to be added to one of the slides. Otherwise, the carousel will not be visible
	- Carousels require the use of an id on the outermost container (the .carousel) for carousel controls to function properly. When adding multiple carousels, or when changing a carousel's id, be sure to update the relevant controls
	- The data-ride="carousel" attribute is used to mark a carousel as animating starting at page load. It cannot be used in combination with (redundant and unnecessary) explicit JavaScript initialization of the same carousel

	Data API Usage
		#targetId.carousel.slide[data-ride=carousel]
			<!-- indicators -->
			ol.carousel-indicators
				li[data-target=#<targetId>,data-slide-to=<num>].active
				...
			<!-- slides -->
			.carousel-inner
				.item.active
					img
					.carousel-caption
				...
			<!-- controls -->
			a.left.carousel-control[href=#<targetId>,data-slide=prev]
				span.glyphicon.glyphicon-chevron-left
				span.sr-only{Previous}
			a.right.carousel-control[href=#<targetId>,data-slide=next]
				span.glyphicon.glyphicon-chevron-right
				span.sr-only{Next}

	JS Usage
		Methods
			.carousel(options)
			.carousel('cycle')
			.carousel('pause')
			.carousel(number)
			.carousel('prev')
			.carousel('next')
		Options
			interval		number
			pause		string
			wrap		boolean
			keyboard	boolean
		Events
			slide.bs.carousel
			slid.bs.carousel
Affix.js
*	- you must provide CSS for the positioning and width of your affixed content

	Data API Usage
		[data-spy=affix,data-offset-top=<num>,data-offset-bottom=<num>]

	JS Usage
		Methods
			.affix(option)
		Options
			offset	number | function | object
			target	selector | node | jQuery | element
		Event
			affix.bs.affix
			affixed.bs.affix
			affix-top.bs.affix
			affixed-top.bs.affix
			affix-bottom.bs.affix
			affixed-bottom.bs.affix