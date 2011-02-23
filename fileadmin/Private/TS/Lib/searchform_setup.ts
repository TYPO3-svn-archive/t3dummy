lib.searchform = COA
lib.searchform {
	10 = TEXT
	10 {
		typolink.parameter = {$lib.searchform.targetPid}
		typolink.returnLast = url
		wrap = <form action="|">
	}

	20 = COA
	20 {
		10 = TEXT
		10.value = <input type="text" class="searchinput" name="tx_indexedsearch[sword]" value="Suchbegriff eingeben"/>
		20 = TEXT
		20.value = <input type="submit" class="submit" name="tx_indexedsearch[submit_button]" value="Suchen" />
		wrap = <div class="searchwrap">|</div>
    }

	30 = TEXT
	30.value = </form>
	
	stdWrap.wrap = <div id="searchform">|</div>
}