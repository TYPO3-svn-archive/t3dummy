lib.logo = IMAGE
lib.logo{
  file = {$lib.logo.src}
  stdWrap.typolink.parameter = {$lib.logo.homePid}
  altText = {$lib.logo.altText}
  stdWrap.wrap = <div id="logo">|</div>
}

[globalVar = LIT:1 = {$page.page.useMarkerbasedTemplating}]
page.10.marks.LOGO < lib.logo
[global]