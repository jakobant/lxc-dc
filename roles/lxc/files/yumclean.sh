#!/bin/bash

for a in `lxc-ls`
do
ssh $a "yum clean all"
done
