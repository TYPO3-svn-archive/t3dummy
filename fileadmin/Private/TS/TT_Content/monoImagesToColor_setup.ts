tt_content.image.20.1.file.params = {$tt_content.monoImagesToColor.IMCommand}
[globalVar = LIT:1 = {$tt_content.monoImagesToColor.mouseoverTrigger}]
tt_content.image.20.1{
  params.cObject = COA
  params.cObject{
    10 = IMG_RESOURCE
    10.file < tt_content.image.20.1.file
    10.file.params >
  	10.stdWrap.wrap = onmouseover="this.src='|';"
  	20 = IMG_RESOURCE
  	20.file < tt_content.image.20.1.file
  	20.stdWrap.noTrimWrap = | onmouseout="this.src='|';"|	
	}
}
[global]