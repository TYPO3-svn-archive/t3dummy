lib.subcontent = CONTENT
lib.subcontent {
  table = tt_content
  select {
    pidInList = {$lib.subcontent.subcontent.pid}
    orderBy = sorting
  }
}

lib.subcontent2 < lib.subcontent
lib.subcontent2.select.pidInList = {$lib.subcontent.subcontent2.pid}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.SUBCONTENT < lib.subcontent
page.10.marks.SUBCONTENT2 < lib.subcontent2
[global]