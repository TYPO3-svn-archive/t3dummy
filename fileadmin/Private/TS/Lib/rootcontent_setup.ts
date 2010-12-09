#### Vererbung mit kbcontslide
lib.rootcontent < plugin.tx_kbcontslide_pi1
lib.rootcontent.content.select.where = colPos=1

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.ROOTCONTENT < lib.rootcontent
[global]