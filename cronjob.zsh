#! /bin/zsh

ht=$0:A:h/public/.htaccess
while read line; do
    var=$(print $line | awk '{print $2}')
    val=$(print $line | awk '{print $3}')
    eval $var=$val
    export $var
done < <(cat $ht | grep SetEnv)

mysql -u$ALUMNI_DATABASE_USER -p"$ALUMNI_DATABASE_PASSWORD" $ALUMNI_DATABASE_NAME <<EOF
delete from confirmation_codes where expires < now();
EOF

