# -*- coding: utf-8 -*-
"该脚本主要用于接收Python命令行的参数并处理"
import sys

#中文采用decode解码，否则命令行下会出现乱码
#sys.argv是一个参数数组,所有命令行的参数都会存入到这个数组中去
print '脚本名:',sys.argv[0] #sys.argv[0]参数数组中的第一个元素，即脚本路径和名称


#循环打印出除脚本名之外的所有命令行的参数值
for i in range(1,len(sys.argv)):

    print "参数",i,sys.argv[i]