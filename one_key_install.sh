#!/bin/bash
##########################################
# File Name: lasy_setup_ss.sh
# Author: Allan Xing
# Modify :Lyfing
##########################################

#----------------------------------------
INIT_DIR=$(pwd)

#check OS version
CHECK_OS_VERSION=`cat /etc/issue |sed -n 1"$1"p|awk '{printf $1}' |tr 'a-z' 'A-Z'`

#list the software need to be installed to the variable FILELIST
UBUNTU_TOOLS_LIBS="git-core python-m2crypto python-pip  supervisor    \
			php5 php5-mcrypt php5-curl php5-gd php5-json php5-mysqlnd openssl"

## check whether system is Ubuntu or not
function check_OS_distributor(){
	echo "checking distributor and release ID ..."
	if [[ "${CHECK_OS_VERSION}" == "UBUNTU" ]] ;then
		echo -e "\tCurrent OS: ${CHECK_OS_VERSION}"
		UBUNTU=1
	else
		echo "not support ${CHECK_OS_VERSION} now"
		exit 1
	fi
}

## update system
function update_system()
{
	if [[ ${UNUNTU} -eq 1 ]];then
	{
		echo "apt-get update"
		apt-get update
	}
	fi
}

#install one software every cycle
function install_soft_for_each(){
	echo "check OS version..."
	check_OS_distributor
	if [[ ${UBUNTU} -eq 1 ]];then
		cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
		echo "Will install below software on your Ubuntu system:"
		update_system
		for file in ${UBUNTU_TOOLS_LIBS}
		do
			trap 'echo -e "\ninterrupted by user, exit";exit' INT
			echo "========================="
			echo "installing $file ..."
			echo "-------------------------"
			apt-get install $file -y
			sleep 1
			echo "$file installed ."
		done
	else
		echo "Other OS not support yet, please try Ubuntu or CentOs"
		exit 1
	fi
}

#setup lyfing ss
function setup_lyfing()
{
	cd ${INIT_DIR}

	touch storage/database.sqlite

    curl -sS https://getcomposer.org/installer |  php -d detect_unicode=Off

    mv composer.phar /usr/local/bin/composer

    chmod +x /usr/local/bin/composer

    composer install

    php artisan key:generate

    php artisan migrate

    php artisan db:seed

}


#config supervisor
function config_supervisor()
{
	cd ${INIT_DIR}

	#pip install cymysql
	# 安装supervisor
	cd /etc/supervisor/conf.d

	rf -rf shadowsocks.conf
    touch shadowsocks.conf
    echo "[program:shadowsocks]" >> shadowsocks.conf
	echo "command=python server.py" >> shadowsocks.conf
	echo "autorestart=true" >> shadowsocks.conf
	echo "user=root" >> shadowsocks.conf
	echo "directory=${INIT_DIR}/shadowsocks/shadowsocks" >> shadowsocks.conf

    rf -rf phpweb.conf
    touch phpweb.conf
     echo "[program:phpweb]" >> phpweb.conf
     echo "command=php -S 0.0.0.0:80" >> phpweb.conf
     echo "autorestart=true" >> phpweb.conf
     echo "user=root" >> phpweb.conf
     echo "directory=${INIT_DIR}/public" >> phpweb.conf

     rf -rf finalspeed.conf
     touch finalspeed.conf
     echo "[program:finalspeed]" >> finalspeed.conf
     echo "command=java -jar fs.jar" >> finalspeed.conf
     echo "autorestart=true" >> finalspeed.conf
     echo "user=root" >> finalspeed.conf
     echo "directory=/fs" >> finalspeed.conf

    echo "ulimit -n 51200" >> /etc/profile
    echo "ulimit -Sn 4096" >> /etc/profile
    echo "ulimit -Hn 8192" >> /etc/profile

    echo "ulimit -n 51200" >> /etc/default/supervisor
    echo "ulimit -Sn 4096" >> /etc/default/supervisor
    echo "ulimit -Hn 8192" >> /etc/default/supervisor
    cd ${INIT_DIR}
	echo "======================生成supervisor 文件在/etc/supervisor/conf.d===================================="
}


function restart_supervisor()
{
	service supervisor restart
    supervisorctl update
	supervisorctl restart all
	echo "======================直接ip 访问===================================="
}
#add job
function add_job(){
	C_USER=$(whoami)
	echo "* * * * * php ${INIT_DIR} artisan schedule:run 1>> /dev/null 2>&1" >> /var/spool/cron/crontabs/${C_USER}
	echo "0 2 * * * supervisorctl restart all 1 >> /dev/null 2>&1" >> /var/spool/cron/crontabs/${C_USER}

	echo "======================配置定时任务===================================="
}


#judge whether root or not
if [ "$UID" -eq 0 ];then
    install_soft_for_each
	setup_lyfing
	config_supervisor
	restart_supervisor
	add_job
else
	echo -e "please run it as root user again !!!\n"
	exit 1
fi

