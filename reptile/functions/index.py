#!/user/local/bin/python2.7
# -*- coding:utf-8 -*-

from spider.mainSpider import mainSpider
from sql.v9_news import v9_news
from sql.v9_news_data import v9_news_data
#from multiprocessing.dummy import Pool
import warnings
import sys
import re

warnings.filterwarnings("ignore",".*",Warning,"sql.sqlHelper",63)

def main():
    spider = mainSpider()
    v9_new = v9_news()
    v9_data = v9_news_data()
    #先将数据库中的表清空
    v9_new.deleteAllFromV9()
    v9_data.deleteAllFromV9_data()
    keyword = sys.argv[1]

    page = int(sys.argv[2])
    news_number = int(sys.argv[3])
    # keyword = "军事"
    # page = 3
    # news_number = 100
    # 将%替换为空格
    keyword = re.sub('%',' ',keyword)
    #如果关键字中有空格，替换空格
    keyword = keyword.replace(' ','%20')
    for number in xrange(0,page*10,10):
        root_url = 'https://www.baidu.com/s?wd='+str(keyword)+'&pn='+str(number)
        new_urls,data_count = spider.crawlSpiderSaveDBFirst(root_url,news_number,keyword)
        if new_urls is None or data_count>=news_number:
            break 
        
    #爬取数据
    if data_count<=news_number:
        count = spider.crawlSpiderSaveDbSecond(page,news_number,keyword)
        print '共抓取到%d条数据！'%count
    
  
if __name__ =='__main__':
    main()
    
    
        
    
        
        
    
    
    
    
    
    
    
    
    
    
    
