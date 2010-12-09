page = PAGE
page {
  config.doctype = {$page.page.doctype}
  includeCSS.main = fileadmin/Public/CSS/style.css
  shortcutIcon = fileadmin/Public/Images/favicon.ico
  typeNum = 0
}

[globalVar = LIT:1 = {$page.page.printCssInclude}]
  page.includeCSS.print = fileadmin/Public/CSS/print.css
  page.includeCSS.print.media = print

[globalVar = LIT:1 = {$page.page.rteCssInclude}]
  page.includeCSS.rte = fileadmin/Public/CSS/rte.css

[globalVar = LIT:1 = {$page.page.stuffJsInclude}]
  page.includeJS.stuff = fileadmin/Public/JavaScript/stuff.js

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10 = TEMPLATE
page.10{
	template = FILE
	template.file = {$page.page.markerbasedTemplate}
	marks{
		# Col Normal
		COL0 = CONTENT
		COL0{
			table = tt_content
			select {
				orderBy = sorting
   			languageField = sys_language_uid
   			where = colPos = 0
			}
		}
		# Col Left
		COL1 < .COL0
		COL1.select.where = colPos = 1
		# Col Right
		COL2 < .COL0
		COL2.select.where = colPos = 2
		# Col Border
		COL3 < .COL0
		COL3.select.where = colPos = 3
	}
}
[else]
page.10 = USER
page.10.userFunc = tx_templavoila_pi1->main_page

[global]