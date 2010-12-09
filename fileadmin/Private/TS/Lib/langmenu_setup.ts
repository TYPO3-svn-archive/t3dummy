lib.langmenu = COA
lib.langmenu{
	10 = CONTENT
	10{
		#TODO: This only works with patched core, because sys_* tables are not allowed with CONTENT at the moment
		table = sys_language
		select.where = hidden = 0
		select.pidInList = 0
		renderObj = IMAGE
		renderObj{
			file.import = {$lib.langmenu.gfxpath}
			file.import.field = flag
			stdWrap.typolink{
				parameter.data = TSFE:id
				addQueryString = 1
				additionalParams.cObject = TEXT
				additionalParams.cObject.field = uid
				additionalParams.cObject.wrap = &L=|
				title.field = title
			}
			altText.field = title
			stdWrap.wrap = <li>|</li>
		}
	}
	20 = IMAGE
	20{
		file = {$lib.langmenu.gfxpath}de.gif
		stdWrap.typolink{
			parameter.data = TSFE:id
			addQueryString = 1
			additionalParams = &L=0
			title.field = Deutsch
		}
		altText.field = Deutsch
		stdWrap.wrap = <li>|</li>
	}
	wrap = {$lib.langmenu.wrap}
}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.LANGMENU < lib.langmenu
[global]