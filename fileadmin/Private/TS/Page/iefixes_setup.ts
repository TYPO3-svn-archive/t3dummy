[globalVar = LIT:1 = {$page.iecss.ieCompatibilityMode}] && [browser = msie] && [version=8]
  page.headTag = <head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

[globalVar = LIT:1 = {$page.iecss.ie6css}] && [browser = msie] && [version=6]		
  page.includeCSS.file2000 = fileadmin/Public/CSS/ie6.css

[globalVar = LIT:1 = {$page.iecss.ie7css}] && [browser = msie] && [version=7]
  page.includeCSS.file2000 = fileadmin/Public/CSS/ie7.css

[globalVar = LIT:1 = {$page.iecss.ie8css}] && [browser = msie] && [version=8]
  page.includeCSS.file2000 = fileadmin/Public/CSS/ie8.css

[globalVar = LIT:1 = {$page.iecss.ie6pngFix}] && [browser = msie] && [version=6]
  page.CSS_inlineStyle := appendString(.ieFix {behavior: url({$config.config.baseURL}fileadmin/Public/JavaScript/libraries/iepngfix/iepngfix.htc);})
  page.includeJS.file2001 = fileadmin/Public/JavaScript/libraries/iepngfix/iepngfix_tilebg-min.js

[globalVar = LIT:1 = {$page.iecss.ie6csshover}] && [browser = msie] && [version=6]
  page.CSS_inlineStyle := appendString(body {behavior: url({$config.config.baseURL}fileadmin/Public/JavaScript/libraries/csshover3/csshover.htc);})

[global]