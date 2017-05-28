# client-online
一项局域网聊天工具

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

------------------

# 如何使用

## 服务器
1. ~~下载资源~~
2. 开启windows iis服务（自行百度）
3. 打开cmd输入ipconfig查询内网IP
4. 打开/client/my.js把"localhost"替换成你的内网ip
5. 把/client文件夹的文件全部复制到C:/inetpub/wwwroot中（把iisstart.htm替换掉，加入js文件）
6. 运行/server/deepstream.exe
7. 把你的ip告诉你的朋友！

## 客户端
打开浏览器并输入你朋友的ip即可。
如果本机是服务端，而且通过ip访问不了，那么请在本地改回localhost进行访问。

# 已知问题

## 僵尸玩家（即使已经退出但仍然显示在列表中）
> 解决方法：按F12打开控制台并输入 `_removePlayer('name')`