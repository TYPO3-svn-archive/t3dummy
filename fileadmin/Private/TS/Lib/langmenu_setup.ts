includeLibs.user_tsLangMenu = fileadmin/Private/Scripts/PHP/user_tsLangMenu.php

lib.langmenu = COA
lib.langmenu{

	10 = HMENU
	10{
		special = language
		special.value.cObject = COA
		special.value.cObject {
			10 = USER
			10.userFunc = user_tsLangMenu->getLanguageIds
			10.includeDefault = 1
			10.excludeCurrent = 1
		}
		1 = TMENU
		1 {
			noBlur = 1
			NO.linkWrap = <li>|</li>
		}
	}

	wrap = {$lib.langmenu.wrap}
}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.LANGMENU < lib.langmenu
[global]