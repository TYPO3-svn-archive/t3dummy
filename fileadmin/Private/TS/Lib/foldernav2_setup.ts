<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/Private/TS/Lib/foldernav_setup_rendertypes.ts">

[globalVar = LIT:text = {$lib.foldernav2.rendertype}]
  lib.foldernav2 < tmp.rendertype.text
[globalVar = LIT:gfximg = {$lib.foldernav2.rendertype}]
  lib.foldernav2 < tmp.rendertype.gfximg
  lib.foldernav2{
    1.NO.stdWrap.append{
      file{
        backColor = {$lib.foldernav2.gfx.bgColor}
        transparentColor = {$lib.foldernav2.gfx.bgColor}
        10{
		  offset = 0,{$lib.foldernav2.gfx.fontSize}
		  fontSize = {$lib.foldernav2.gfx.fontSize}
		  fontFile = {$lib.foldernav2.gfx.fontFile}
		  fontColor = {$lib.foldernav2.gfx.fontColor}
        }
      }
      params.cObject{
			10.file < lib.foldernav2.1.NO.stdWrap.append.file
			20 < .10
			20.stdWrap.noTrimWrap = |onmouseover="this.src='|'" |
			20.file.10.fontColor = {$lib.foldernav2.gfx.hoverFontColor}
			stdWrap.if.isTrue = {$lib.foldernav2.gfx.hoverFontColor}
		}
	}
}
[globalVar = LIT:gfxbg = {$lib.foldernav2.rendertype}]
	lib.foldernav2 < tmp.rendertype.gfxbg
	lib.foldernav2.1.NO.stdWrap.cObject.10.file {
		backColor = {$lib.foldernav2.gfx.bgColor}
		transparentColor = {$lib.foldernav2.gfx.bgColor}
		10{
		  offset = 0,{$lib.foldernav2.gfx.fontSize}
		  fontSize = {$lib.foldernav2.gfx.fontSize}
		  fontFile = {$lib.foldernav2.gfx.fontFile}
		  fontColor = {$lib.foldernav2.gfx.fontColor}
		}
	}
[globalVar = LIT:resrcimg = {$lib.foldernav2.rendertype}]
	lib.foldernav2 < tmp.rendertype.resrcimg
[global]

lib.foldernav2{
	special = directory
	special.value = {$lib.foldernav2.folderPid}
	wrap = {$lib.foldernav2.wrap}
}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
	page.10.marks.FOLDERNAV2 < lib.foldernav2
[global]