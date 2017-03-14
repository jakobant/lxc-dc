Play Book for LXC enabled environment
=========

Creates environment that to emulate a typical PaaS setup.
Designed to develop and test playbooks intended for PaaS

Requirements
------------
Needs root permissions to the Machine that will run the containers.
Will work with a VirtualMachine CentOS or RedHat running locally or in ELab environment.

Dependencies
------------
A lot...

What does it do?
------------
Prepares a machine to serve as a LinuX Container host.    Install various support services, Grafana, graphite, dnsmasq, iptables.   Create list of host for the environemnt.
	
- Ansible playbook are then used to setup the servers as it would be in the PaaS environment.
- Ansible-playbooks can be run from a Cygwin Windows host (With the LXC host as a basestation)
- Ansible-playbooks can be run from the LXC host directly to the containers.
 

Example Run
----------------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

    - hosts: "{{ vhost }}"
    vars:
     host_line_code: xx
    roles:
    - lxc

License
-------

BSD
