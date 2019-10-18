#! /bin/zsh

script=$0:A:h/cronjob.zsh
(crontab -l; print "7 * * * * $script") | crontab -
