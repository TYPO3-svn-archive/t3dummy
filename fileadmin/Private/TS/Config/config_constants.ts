config.config{
	#customsubcategory=config.config=General Configuration

	#cat=Site conf.config/config.config/a; type=string; label=Base URL:e.g. http://www.mysite.com/
	baseURL = 
	
	#cat=Site conf.config/config.config/ba; type=boolean; label=Global no_cache:Do only use while site is in development!
	no_cache = 1
	
	#cat=Site conf.config/config/bb; type=options[1 Minute=60,5 Minutes=300,15 Minutes=900,30 Minutes=1800,1 Hour=3600,2 Hours=7200,4 Hours=14400,8 Hours=28800,12 Hours=43200,1 Day=86400,2 Days=172800,3 Days=259200,4 Days=345600,1 Week=604800,10 Days=864000,2 Weeks=1209600,4 Weeks=2419200,1 Month=2678400,3 Months=8035200,6 Months=16070400,1 Year=32140800]; label=Caching duration
	cache_period = 86400
	
	#cat=Site conf.config/config.config/c; type=boolean; label=Enable Admin Panel
	admPanel = 0
	
	#cat=Site conf.config/config.config/d; type=boolean; label=Spam Protect Email Adresses:Link will be JS encrypted and "@" will be replaced with (at)
	spamProtectEmailAddresses = 1
	
	#cat=Site conf.config/config.config/d; type=string; label=Spam Protect Email Adresses:"@" will be replaced by:
	spamProtectEmailAddresses_atSubst = (at)
	
	#cat=Site conf.config/config.config/d; type=string; label=Spam Protect Email Adresses:"." will be replaced by:
	spamProtectEmailAddresses_lastDotSubst = .
	
	#cat=Site conf.config/config.config/d; type=string; label=Meaningful Temp File Prefix: Prepend temp file with x meaningful chars
	meaningfulTempFilePrefix = 60
}