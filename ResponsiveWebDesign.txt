Fluid Images
	a.
		img 
		{
			max-width: 100%;
			height: auto;
		}
	b.
		rwd-images.js + Htaccess + data-fullsrc

Fluid Grids
Media Queries
Font
	use reponsive unit(percent | em | rem)



Fixed Layout
	Overall width is fixed with absolute measurements (px). They’re a solution to the lack of control designing for the web.	
	pros: 	precise control, minimal cost
	cons:	scroll bar when small screen
			large white space when large screen
Liquid | Fluid Layout
	Overall width is set in proportion to the browser window (%). They’re a solution to multiple resolutions.
	using percentage
	pros:
	cons: 	text lines can grow too long
Elastic Layout
	Overall width is set in proportion to some design element, usually font-size (em). They’re a solution to the control issues with fluid designs,Proportions are always maintained to something internal and so the design can better maintain unity
	pros: 	strong typographic control
	cons: 	risk of scroll bar in some rare cases
Hybrid Layout
	Using a combination of fixed and either fluid or elastic design elements. They’re a solution to the cons of all 3 layouts above.
		fixed width content, fluid background
		fluid layout with max width content
Responsive Layout
	Using different stylesheets based on possible ranges of widths of the audience. They’re a solution to the multiple devices and resolutions of our audience.
Fluid/Elastic Grids Layout
	A type of elastic layout that makes use of a grid. They’re a solution to maintaining order inside a dynamic container.


The largest problem is that media queries do not work with older browsers
Response.js  

this set of guidelines (or rules) should be stored in a separate CSS stylesheet from the one in which there are those for the general style (which is usually named style.css).
em is not exactly 16px it will very according to what font you are using. The best way to think of an em is that it is the size of an upper case M in what ever font you are using
The difference is that fluid layouts are measured relative to something external to the design (browser window), while elastic layouts are measured relative to something internal to the design (font-size).