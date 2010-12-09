<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/Private/TS/Lib/foldernav_setup_rendertypes.ts">

[globalVar = LIT:text = {$lib.foldernav.rendertype}]
	lib.foldernav < tmp.rendertype.text
[globalVar = LIT:gfximg = {$lib.foldernav.rendertype}]
	lib.foldernav < tmp.rendertype.gfximg
[globalVar = LIT:gfxbg = {$lib.foldernav.rendertype}]
	lib.foldernav < tmp.rendertype.gfxbg
[globalVar = LIT:resrcimg = {$lib.foldernav.rendertype}]
	lib.foldernav < tmp.rendertype.resrcimg
[global]

lib.foldernav{
  special = directory
  special.value = {$lib.foldernav.folderPid}
  wrap = {$lib.foldernav.wrap}
}

# Marker Based Rendering

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
	page.10.marks.FOLDERNAV < lib.foldernav
[global]