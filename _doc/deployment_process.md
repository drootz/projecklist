# Deployment Process

## SITE
1. Access FTP site Root
2. Copy config.json from remote server into local server "asset" folder
3. Upload FTP to site root
4. Upload saved config.json back
5. On remote server > In includes/config.php :
	- Comment out debug functions
6. On remote Server > In includes/session.php :
	- Replace $_SESSION["server_root"] with server root
	- Change all other local paths
7. On remote Server > In includes/function.php :
	- Replace $_SESSION["server_root"] with server root
	- Change all other local paths
8. On remote Server > In includes/correspondence.php :
	- Change PHP mailer STMP account
	- Change server root paths
9. CHMOD "Send" folder to enable attachment writing

## DATABASE
1. Download local configuation
2. Upload configuartion to remote serve or perform changes manually