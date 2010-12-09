config.disableAllHeaderCode = 1
page >
page = PAGE
page{
	10 = TEMPLATE
	10{
		template = FILE
		template.file = fileadmin/templates/ext/newsletter.html
		marks{
			TITLE = TEXT
			TITLE.field = title
		}
	}
}