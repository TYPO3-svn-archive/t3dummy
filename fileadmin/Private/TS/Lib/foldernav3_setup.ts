<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/Private/TS/Lib/foldernav_setup_rendertypes.ts">

[globalVar = LIT:text = {$lib.foldernav3.rendertype}]
  lib.foldernav3 < tmp.rendertype.text
[globalVar = LIT:gfximg = {$lib.foldernav3.rendertype}]
  lib.foldernav3 < tmp.rendertype.gfximg
  lib.foldernav3{
    1.NO.stdWrap.append{
      file{
        backColor = {$lib.foldernav3.gfx.bgColor}
        transparentColor = {$lib.foldernav3.gfx.bgColor}
        10{
		  offset = 0,{$lib.foldernav3.gfx.fontSize}
		  fontSize = {$lib.foldernav3.gfx.fontSize}
		  fontFile = {$lib.foldernav3.gfx.fontFile}
		  fontColor = {$lib.foldernav3.gfx.fontColor}
        }
      }
      params.cObject{
			10.file < lib.foldernav3.1.NO.stdWrap.append.file
			20 < .10
			20.stdWrap.noTrimWrap = |onmouseover="this.src='|'" |
			20.file.10.fontColor = {$lib.foldernav3.gfx.hoverFontColor}
			stdWrap.if.isTrue = {$lib.foldernav3.gfx.hoverFontColor}
		}
	}
}
[globalVar = LIT:gfxbg = {$lib.foldernav3.rendertype}]
	lib.foldernav3 < tmp.rendertype.gfxbg
	lib.foldernav3.1.NO.stdWrap.cObject.10.file {
		backColor = {$lib.foldernav3.gfx.bgColor}
		transparentColor = {$lib.foldernav3.gfx.bgColor}
		10{
		  offset = 0,{$lib.foldernav3.gfx.fontSize}
		  fontSize = {$lib.foldernav3.gfx.fontSize}
		  fontFile = {$lib.foldernav3.gfx.fontFile}
		  fontColor = {$lib.foldernav3.gfx.fontColor}
		}
	}
[globalVar = LIT:resrcimg = {$lib.foldernav3.rendertype}]
	lib.foldernav3 < tmp.rendertype.resrcimg
[global]

lib.foldernav3{
	special = directory
	special.value = {$lib.foldernav3.folderPid}
	wrap = {$lib.foldernav3.wrap}
}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
	page.10.marks.FOLDERNAV3 < lib.foldernav3
[global]