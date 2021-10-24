.PHONY: sail
sail:
	alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
