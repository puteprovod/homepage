from PIL import Image
import json
with open('public/request.json') as js:
    sl = json.load(js)
print(len(sl['images']))
for i in range (len(sl['images'])):
    with Image.open(sl['images'][i]['path']) as img:
        img.load()
    reimg = img.resize((sl['images'][i]['targetWidth'], sl['images'][i]['targetHeight']), 1)
    reimg.save(sl['images'][i]['filename'],quality=90)
    sl['images'][i]['done'] = 'yes'
print ('done')

