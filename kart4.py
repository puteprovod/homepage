from PIL import Image
from numba import njit
import json
import sys

filepath = sys.argv[1]
with open(filepath) as js:
    sl = json.load(js)

@njit
def start ():
    for i in sl['images']:
        ximg = Image.open(i['path'])
        ximg.load()
        reimg = ximg.resize((i['targetWidth'], i['targetHeight']),1)
        reimg.save(i['filename'],quality=90)
        thumbimg = reimg.resize((i['thumbWidth'], i['thumbHeight']),1)
        thumbimg.save(i['thumbfilename'],quality=90)
    print ("done")
start()
