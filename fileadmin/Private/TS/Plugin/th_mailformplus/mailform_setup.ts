plugin.tx_thmailformplus_pi1{
	debug = 0
	default{
		email_to      = sebastiangebhard@hoch2.de
		email_htmltemplate = fileadmin/templates/mailformplus/buchung_geburtstag.html
		email_subject    = Neue Buchungsanfrage (Kindergeburtstag) auf fehmare.de
		email_subject_user = Ihre Kontaktanfrage auf fehmare.de
		email_sender    = info@hoch2.de
	}
	fieldConf{
		email {
    	errorCheck = email,required
    	errorText = <li>E-mail ist ein Pflichtfeld - bitte ausfüllen.</li>
 		}
		vorname {
    	errorCheck = required
    	errorText = <li>Vorname ist ein Pflichtfeld - bitte ausfüllen.</li>
 		}
		name {
    	errorCheck = required
    	errorText = <li>Name ist ein Pflichtfeld - bitte ausfüllen.</li>
 		}
		datenschutz {
    	errorCheck = required
    	errorText = <li>Datenschutz ist ein Pflichtfeld - bitte ausfüllen.</li>
		}
	}
}