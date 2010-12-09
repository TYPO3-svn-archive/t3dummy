# Felder ausblenden, die grundsätzlich nicht genutzt werden 
TCEFORM{
  pages{
    author.disabled = 1
    author_email.disabled = 1
    abstract.disabled = 1
    lastUpdated.disabled = 1
    target.disabled = 1
    layout.disabled = 1
    
    # Verwende tx_realurl_pathsegment // "Pfadsegment für untergeordnete Seiten"
    alias.disabled = 1
    
    # Verwende TS Konstante in Site Conf.Config zum Deaktivieren des Cache für eine Seite
    no_cache.disabled = 1
    
    # Verwende TS Konstante in Site Conf.Config zum Konfigurieren des Cache für eine Seite
    cache_timeout.disabled = 1
    
    # Verwende nur direkte Shortcuts um DC zu vermeiden
    shortcut_mode.disabled = 1
    
    # Duplicate Content!
    content_from_pid.disabled = 1
    
  }
}


# Rahmen entfernen
TCEFORM.tt_content.section_frame {
	removeItems = 1,5,6,10,11,12,20,21   
}

# �berfl�ssige Tabellen ausblenden
mod.web_list.hideTables = static_template,sys_note

# Content Wizard Items ausblenden, die grundsätzlich nicht genutzt werden
mod.wizards.newContentElement{
	renderMode = tabs
	wizardItems{
		common{
			elements{
				headline{
					icon = gfx/i/tt_content_header.gif
					title = Überschrift
					description = Reines Überschriften-Element
					tt_content_defValues{
						CType = header
					}
				}
				bullets >
				table >
			}
			show = headline,text,textpic,image
		}
		special.elements{
			div >
			menu >
		}
		forms.elements{
			search >
		}
	}
}

# Copy settings for TV
templavoila.wizards.newContentElement{
	renderMode = tabs
	wizardItems{
		common{
			elements{
				headline{
					icon = gfx/i/tt_content_header.gif
					title = Überschrift
					description = Reines Überschriften-Element
					tt_content_defValues{
						CType = header
					}
				}
				bullets >
				table >
			}
			show = headline,text,textpic,image
		}
		special.elements{
			div >
			menu >
		}
		forms.elements{
			search >
		}
	}
}

options.stfl-tmpl2columns.enable = true
options.stfl-tmpl2columns.default_main = main
options.stfl-tmpl2columns.mapping {

	default = 0
	

}



options.stfl-tmpl2columns.default_content = default
options.stfl-tmpl2columns.mapping {

	default = 0,1,2,3

	

}
