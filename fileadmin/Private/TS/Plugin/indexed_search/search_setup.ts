config.index_enable = {$plugin.indexed_search.search.index_enable}

lib.searchform = COA
lib.searchform{
	10 = TEXT
	10{
		typolink.parameter = 89
		typolink.returnLast = url
		wrap = <form class="searchbox clearfix" action="|" method="post">
	}
	
	30 = TEXT
	30.data = {GPvar:L}
	30.intval = 1
	30.wrap = <input type="hidden" name="tx_indexedsearch[lang]" value="L|" />
	
	150 = TEXT
	150.value = <input class="searchinput" type="text" name="tx_indexedsearch[sword]" /><input class="searchsubmit" type="submit" value="Suche starten" />
	150.wrap = <div class="searchinputwrap">|</div>
	
	900 = TEXT
	900.value = </form>
}