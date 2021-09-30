import time
import urllib.request
import requests
import re
import random

def download_img(src, file_path):
    time.sleep(1)
    try:
        with urllib.request.urlopen(src) as data:
            img = data.read()
            with open(file_path, 'wb') as f:
                f.write(img)
    except:
        pass

def scraping(url, regs):
    headers = {
        'User-Agent' : 'saito/1.0(hidesakai6@gmail.com)'
    }
    content = {}

    html = requests.get(url, headers=headers).text

    for key, reg in regs.items():
        if(key == 'next_url'):
            content[key] = random.choice(re.findall(reg, html))
        else:
            content[key] = re.search(reg, html).group(1)
    return content



def main():
    urls = {
        "ws" : "https://websv.info/service/page/"
    }

    start_regs = {
                'ws' : {
                            'next_url' : 'contents-box">\n<a href="(.+?)"'
                }
    }
    
    
    regs = {
                'ws' : {
                            'detail' : 'entry-content in.+?>\n\n<h2>.+?</h2>\n\n<p>(.+?)<',
                            'link' : "btn_svurl.+?\n.+?'(.+?)' ",
                            'tag' : "svtag tagcloud.+?><.+?>(.+?)<",
                            'image' : 'catch_img.+? .+? src="(.+?)"',
                            'next_url' : 'contents-box">\n<a href="(.+?)"'
                },
                
    }

    page = random.randint(2,11)
    page_url = urls['ws']+str(page)
    url = scraping(page_url, start_regs['ws'])['next_url']

    for i in range(5):
        content = scraping(url, regs['ws'])
        content['url'] = url
        if(content['url']):
            print(content)
        url = content['next_url']
        time.sleep(1)


    #image_url = "https://websv.info/wp-content/uploads/2021/02/1-1.jpg"
    #download_img(image_url, "images/test.jpg")

main()