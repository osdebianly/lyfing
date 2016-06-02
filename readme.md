## Lyfing  
Base on Laravel Boilerplate

![主界面](/screenshot/screenshot_index.png?raw=true "Optional Title")



### 介绍

通过该应用可以分享[互联网](http://www.googel.com)自己给身边的朋友或者有需要的朋友


### 手动安装

#### 环境要求
   * Ubuntu 14.04
   * PHP 5.6 or 7
   * supervisor
   * Git

#### 安装步骤

##### Step 0
````
apt-get update
apt-get install -y git
git clone https://github.com/osdebianly/osdebianly/lyfing.git
cd lyfing
````

##### Step 1

开始熟悉的 [larave配置](http://laravelacademy.org/post/46.html) 
熟悉请略过
```
php artisan serve --host 0.0.0.0 --port 80

```
##### Step 2

 - 打开 http://your_ip ，正常情况下就可以看到页面了
 - 初始化账号：
 - 管理员： admin@admin.com     密码：admin
 - 公共账号： public@public.com    密码:user
 
 如果无法打开，执行下面关闭iptables 试试
``` 
 iptables -P INPUT ACCEPT
 iptables -P FORWARD ACCEPT
 iptables -P OUTPUT ACCEPT
 iptables -F
 
```

### 懒人必备一键安装

首先还是要一下,然后切换到root 安装

```
su root

./one_install.sh

```

漫长的等待...............


#为什么叫lyfing

我觉得[Lyfing](https://github.com/osdebianly/lyfing)更有逼格 
![lyfing](/screenshot/rengxing.jpeg?raw=true "Optional Title")

### 反馈

移步到[这里](https://github.com/osdebianly/lyfing/issues).由于这个项目是业余时间维护,我不能保证一一满足
![issue](/screenshot/xiangxin.jpeg?raw=true "Optional Title")


### License

MIT: [http://anthony.mit-license.org](http://anthony.mit-license.org)