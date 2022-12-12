from PIL import Image
import json
import sys

filepath = sys.argv[1]
with open(filepath) as js:
    sl = json.load(js)

for i in sl['images']:
    with Image.open(i['path']) as img:
        img.load()
    reimg = img.resize((i['targetWidth'], i['targetHeight']),1)
    reimg.save(i['filename'],quality=90)
    thumbimg = reimg.resize((i['thumbWidth'], i['thumbHeight']),1)
    thumbimg.save(i['thumbfilename'],quality=90)

print ("done")
