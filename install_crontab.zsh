#! /bin/zsh

if [[ -n $(crontab -l | grep alumni) ]]; then
    print "Crontab for alumni already installed. Aborting."
    exit
fi

script=$0:A:h/cronjob.zsh
(crontab -l; print "7 * * * * $script") | crontab -
