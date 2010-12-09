page.page{
  
  #cat=Site conf.page/enable/tv; type=boolean; label=LLL:fileadmin/Private/TS/locallang.xml:const.page.useMarkerbasedTemplating
  useMarkerbasedTemplating = 0
  
  #cat=Site conf.page/file/tmpl; type=string; label=LLL:fileadmin/Private/TS/locallang.xml:const.page.markerbasedTemplate
  markerbasedTemplate = fileadmin/templates/main/default.html

  #cat=Site conf.page/file/printcss; type=boolean; label=LLL:fileadmin/Private/TS/locallang.xml:const.page.printCssInclude
  printCssInclude = 0
  
  #cat=Site conf.page/file/rtecss; type=boolean; label=LLL:fileadmin/Private/TS/locallang.xml:const.page.rteCssInclude
  rteCssInclude = 0

  #cat=Site conf.page/file/stuffjs; type=boolean; label=LLL:fileadmin/Private/TS/locallang.xml:const.page.stuffJsInclude
  stuffJsInclude = 0

  #cat=Site conf.page/other/html; type=options[XHTML=xhtml_trans,HTML5=html_5]; label=Doctype: XHMTL oder HTML5
  doctype = xhtml_trans
  
}