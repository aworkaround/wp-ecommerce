# Steps

1. Create an account on Linode
2. Create a Linode. Go ot Linodes ==> Create Linode
3. Linux Distribution (Debian 11) ==> Region (India, Mumbai) ==> Shared CPU (Nanode 1 GB) ==> Label (wordpress) ==> Root Password (SecurePass321345)
4. Firewall ==> Create Firewall ==> Label (wordpress) ==> Create Firewall
5. Create Linode.
6. Go to firewalls
7. Click on wordpress filewall ==> Add an Inbound Rule ==> Preset (SSH) ==> Add Rule
8. Add an Inbound Rule ==> Label (wordpress) ==> Protocol (TCP) ==> Ports (Custom) ==> Custom Port Range (8080) ==> Sources (All) ==> Add Rule.
9. Save Changes
10. Go to Linodes
11. Wait for PROVISIONING to change into RUNNING state.
12. Copy SSH Access block. E.g. `ssh root@<ip-address>`
13. Open Terminal on your Laptop ==> Paste the SSH block `ssh root@<ip-address>` and hit enter.
14. Type `yes`
15. Type in the password you used while creating new Linode.
16. Run command `apt update && apt upgrade -y && apt install git -y`
17. Run command `git clone https://github.com/aworkaround/wp-ecommerce.git`
18. Run command `cd wp-ecommerce`
19. Run command `chmod +x commands.sh`
20. Run command `./commands.sh`
21. Go to browser, type `http://<linode-ip-address>:8080`
