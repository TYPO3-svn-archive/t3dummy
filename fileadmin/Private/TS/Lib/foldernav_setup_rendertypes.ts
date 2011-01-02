tmp.rendertype.text = HMENU
tmp.rendertype.text{
  1 = TMENU
  1{
  	noBlur = 1
    NO.wrapItemAndSub = <li class="first">|</li>|*|<li>|</li>
    ACT = 1
    ACT.wrapItemAndSub = <li class="act first">|</li>|*|<li class="act">|</li>
  }
}

tmp.rendertype.gfxbg = HMENU
tmp.rendertype.gfxbg {
	1 = TMENU
	1 {
		noBlur = 1
		NO = 1
		NO.wrapItemAndSub = <li class="first">|</li>|*|<li>|</li>
		NO.stdWrap.setContentToCurrent = 1
		NO.stdWrap.cObject = COA
		NO.stdWrap.cObject {
			10 = IMG_RESOURCE
			10 {
			  file = GIFBUILDER
			  file{
				backColor = {$lib.foldernav.gfx.bgColor}
				transparentBackground = 1
				transparentColor = {$lib.foldernav.gfx.bgColor}
				transparentColor.closest= 1
				XY = [10.w]+4,[10.h]+5
				10 = TEXT
				10{
				  text.field = title
				  text.case = upper
				  offset = 0,{$lib.foldernav.gfx.fontSize}
				  fontSize = {$lib.foldernav.gfx.fontSize}
				  fontFile = {$lib.foldernav.gfx.fontFile}
				  fontColor = {$lib.foldernav.gfx.fontColor}
                }
			  }
			  stdWrap.wrap = <span class="title" style="background-image:url('|')">
			}
			20 = TEXT
			20.current = 1
			20.wrap = |</span>
		}
	}
}

tmp.rendertype.gfximg = HMENU
tmp.rendertype.gfximg{
  1 = TMENU
  1{
    noBlur = 1
  	NO = 1
    NO.wrapItemAndSub = <li class="first">|</li>|*|<li>|</li>
    NO.stdWrap.wrap = <span class="title">|</span>
    NO.stdWrap.append = IMAGE
    NO.stdWrap.append{
      file = GIFBUILDER
      file{
        backColor = {$lib.foldernav.gfx.bgColor}
        transparentBackground = 1
        transparentColor = {$lib.foldernav.gfx.bgColor}
        transparentColor.closest= 1
        XY = [10.w]+4,[10.h]+5
        10 = TEXT
        10{
          text.field = title
          text.case = upper
          offset = 0,{$lib.foldernav.gfx.fontSize}
          fontSize = {$lib.foldernav.gfx.fontSize}
          fontFile = {$lib.foldernav.gfx.fontFile}
          fontColor = {$lib.foldernav.gfx.fontColor}
        }
      }
      altText.field = title
      params.cObject = COA
      params.cObject{
      	10 = IMG_RESOURCE
      	10.stdWrap.noTrimWrap = | onmouseout="this.src='|'" |
      	10.file < tmp.rendertype.gfximg.1.NO.stdWrap.append.file
      	20 < .10
      	20.stdWrap.noTrimWrap = | onmouseover="this.src='|'" |
      	20.file.10.fontColor = {$lib.foldernav.gfx.hoverFontColor}
				stdWrap.if.isTrue = {$lib.foldernav.gfx.hoverFontColor}
      }
      wrap = <span class="imagewrap">|</span>
    }    
    ACT < .NO
    ACT.wrapItemAndSub = <li class="act first">|</li>|*|<li class="act">|</li>
  }
}

tmp.rendertype.resrcimg = HMENU
tmp.rendertype.resrcimg{
	1 = TMENU
  1{
    noBlur = 1
  	NO = 1
    NO.wrapItemAndSub = <li class="first">|</li>|*|<li>|</li>
    NO.stdWrap.wrap = <span class="title">|</span>
    NO.stdWrap.append = IMAGE
    NO.stdWrap.append{
    	file.import = uploads/media/
    	file.import.field = media
    	file.import.listNum = 0
    	params.cObject = COA
		params.cObject{
      	10 = IMG_RESOURCE
      	10.stdWrap.noTrimWrap = |onmouseout="this.src='|'" |
      	10.file < tmp.rendertype.resrcimg.1.NO.stdWrap.append.file
      	20 < .10
      	20.stdWrap.noTrimWrap = |onmouseover="this.src='|'" |
      	20.file.import.listNum = 1
				stdWrap.if.isTrue.field = media
				stdWrap.if.isTrue.listNum = 1
      }
      altText.field = title
      wrap = <span class="imagewrap">|</span>
    }    
    ACT < .NO
	ACT.stdWrap.append.file.import.listNum = 0
	ACT.stdWrap.append.file.import.listNum.stdWrap.override.cObject = TEXT
	ACT.stdWrap.append.file.import.listNum.stdWrap.override.cObject{
					value = 2
					if.isTrue.field = media
					if.isTrue.listNum = 2
	}
	ACT.stdWrap.append.params.cObject.10.file < tmp.rendertype.resrcimg.1.ACT.stdWrap.append.file
	ACT.wrapItemAndSub = <li class="act first">|</li>|*|<li class="act">|</li>
  }
}