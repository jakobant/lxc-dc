#!/bin/bash

for a in `lxc-ls`
do
ssh $a "/usr/sbin/logrotate -f /etc/logrotate.conf"
done
