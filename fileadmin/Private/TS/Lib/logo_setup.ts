[globalVar = LIT:imagetag = {$lib.logo.rendertype}]
lib.logo = IMAGE
lib.logo{
  file = {$lib.logo.src}
  stdWrap.typolink.parameter = {$lib.logo.homePid}
  altText = {$lib.logo.altText}
}
[else]
lib.logo = TEXT

lib.logo {
	wrap = <span id="toplogo">|</span>
	typolink.parameter = {$lib.logo.homePid}
	typolink.additionalParams.dataWrap = &L={GPVar:L}
	typolink.wrap = <span class="txt">|</span>
	typolink.ATagBeforeWrap = 1
	typolink.title = {$lib.logo.altText}
}
[global]

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.LOGO < lib.logo
[global]