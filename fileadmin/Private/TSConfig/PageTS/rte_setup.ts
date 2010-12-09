RTE {
	default {
		contentCSS = fileadmin/Public/CSS/rte.css
		showTagFreeClasses = 1
		proc.allowedClasses := addToList(countingtable)
		classesTable := addToList(countingtable)
		
		# Classes: Ausrichtung
        classesParagraph (
                align-left, align-center, align-right, linkMitPfeil, footerLink
        )
 
        # Classes: Eigene Stile
        classesCharacter = author, linkMitPfeil
        classesImage= rte_image
 
 
        # Classes f&#8730;¼r Links (These classes should also be in the list of allowedClasses)
        classesAnchor = external-link, external-link-new-window, internal-link, internal-link-new-window, download, mail,linkMitPfeil,footerLink
        classesAnchor.default {
                page = internal-link
                url = external-link-new-window
                file = download
                mail = mail
                linkMitPfeil = linkMitPfeil
                footerLink = footerLink
        }
		
  }
	classes {
		countingtable{
			name = Nummerierte Tabelle
			counting{
				rows {
					startAt = 1
					rowClass = tr-count-
					rowLastClass = tr-last
					rowHeaderClass = thead-count-
					rowHeaderLastClass = thead-last
    		}
				columns {
					startAt = 1
					columnClass = td-count-
					columnLastClass = td-last
					columnHeaderClass = th-count-
					columnHeaderLastClass = th-last
				}
			}
		}
	}
}