######################################################## Double Headline Links

Header1 = IMAGE
Header1.stdWrap.typolink{
    parameter.insertData = 1
    parameter = {field:header_link}
}

Header1.file = GIFBUILDER
Header1.file {
	
	XY = 610,61
	backColor = {$colorHdlBg}
	transparentColor = {$colorHdlBg}
	transparentBackground = 1
	transparentColor.closest=1
	
	10 = TEXT
	10.text.field = header
	10.text.listNum = 0
	10.text.listNum.splitChar = |
	10.fontFile = {$fontHeadline1Big}
	10.fontColor = {$colorHdl1}
	10.fontSize = 30
	10.niceText = 1
	10.niceText.scaleFactor = 5
	10.offset = 0,26
	
	15 < .10
	15.text.listNum = 1
	15.niceText.sharpen = 0
	15.fontColor ={$colorHdl2}
	15.fontSize = 25
	15.fontFile = {$fontHeadline1Small}
	15.offset = 0,55
	
	
}

lib.stdheader.10.1 >
lib.stdheader.10.1 < Header1
lib.stdheader.10.1.wrap = <h1 class="headerwrap1">|</h1>
lib.stdheader.10.1.altText.field=header
