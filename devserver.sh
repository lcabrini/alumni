#! /bin/zsh

ht=public/.htaccess
while read line; do
    var=$(print $line | awk '{print $2}')
    val=$(print $line | awk '{print $3}')
    eval $var=$val
    export $var
done < <(cat $ht | grep SetEnv)

php -S localhost:8000 -t public
