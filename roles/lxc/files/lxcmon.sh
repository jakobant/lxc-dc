#!/bin/bash
# mon to graphite... 
# Simple mon
GSERVER="127.0.0.1"
GPORT="2003"

MM=/tmp/stuff
X=/tmp/x
DD=`date +%s`
PRE="stats"
rm  $MM
for a in `lxc-ls`
do
lxc-info -H --name $a > $X
NAME=`cat $X|grep Name|awk '{print $2}'`
CPU=`cat $X|grep CPU|awk '{print $3}'`
IOPS=`cat $X|grep BlkIO|awk '{print $3}'`
MEM=`cat $X|grep Memory|awk '{print $3}'`
NI=`cat $X|grep "TX b"|awk '{print $3}'`
NO=`cat $X|grep "RX b"|awk '{print $3}'`
echo "$PRE.$NAME.CPU $CPU $DD" >> $MM
echo "$PRE.$NAME.IOPS $IOPS $DD" >> $MM
echo "$PRE.$NAME.MEM $MEM $DD" >> $MM
echo "$PRE.$NAME.NETIN $NI $DD" >> $MM
echo "$PRE.$NAME.NETOUT $NO $DD" >> $MM
done

cat $MM | nc $GSERVER $GPORT
/usr/bin/lxc-fancy -j > /var/www/html/lxc.json
exit 0
