# client-online
An Online Client Project.

# How to use

## server
1. ~~Download source.~~
2. Open windows iis service. (Google it by your self)
6. Open "cmd" and use command "ipconfig" to check your lan-ip.
8. Replace /client/my.js from "localhost" to your ip-link.
3. Copy files in /client to C:/inetpub/wwwroot. (Replace the iisstart.htm and add js files)
4. Run /server/deepstream.exe.
7. Share your ip to your friend!

## client
1. Open your friend's ip link in Chrome(or other).
2. Enjoy!

# bugs

## Zombie Players. (Quited but still in player list)
> Solution: press F12 and enter command `_removePlayer('name')`