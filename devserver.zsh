#! /bin/zsh

if [[ -z $(whence php) ]]; then
    print "Error: PHP not found on the system"
    print "Unable to continue"
    print "Please install with:"
    print "    sudo dnf install php"
    exit 1
fi

php_version=$(php --version | head -n 1 | awk '{ print $2}')
php_major=$(print $php_version | cut -d. -f1)
php_minor=$(print $php_version | cut -d. -f2)
if [[ $php_major -ne 7 ]]; then
    print "Error: Alumni requires PHP 7"
    exit 1
elif [[ $php_minor -lt 3 ]]; then
    print "Warning: Alumni has only been tested with PHP 7.3"
fi

ht=public/.htaccess
if [[ ! -f $ht ]]; then
    cp $ht.in $ht
    print "The file public/htaccess was not found. Creating a new one"
    print "You will need to configure this before proceeding"
    exit 1
fi

while read line; do
    var=$(print $line | awk '{print $2}')
    val=$(print $line | awk '{print $3}')
    eval $var=$val
    export $var
done < <(cat $ht | grep SetEnv)

php -S localhost:8000 -t public
